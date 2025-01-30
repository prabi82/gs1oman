import puppeteer from 'puppeteer';
import mysql from 'mysql2/promise';
import { jest } from '@jest/globals';
import { EventEmitter } from 'events';

// Increase Jest timeout and set max listeners
jest.setTimeout(300000); // 5 minutes total
EventEmitter.defaultMaxListeners = 20;

describe('Registration Form Tests', () => {
    let browser;
    let page;

    beforeAll(async () => {
        // Launch browser with increased protocol timeout
        browser = await puppeteer.launch({
            protocolTimeout: 60000,
            headless: "new",
            args: ['--no-sandbox', '--disable-setuid-sandbox'],
            executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe'
        });
        page = await browser.newPage();

        // Set longer timeouts for browser operations
        await page.setDefaultNavigationTimeout(60000);
        await page.setDefaultTimeout(60000);

        // Block images only
        await page.setRequestInterception(true);
        page.on('request', request => {
            if (request.resourceType() === 'image') {
                request.abort();
            } else {
                request.continue();
            }
        });

        // Log console messages and errors
        page.on('console', msg => console.log('PAGE LOG:', msg.text()));
        page.on('pageerror', error => console.error('PAGE ERROR:', error.message));

        try {
            // Navigate to page
            await page.goto('http://localhost/gs1oman.com/', {
                waitUntil: 'domcontentloaded',
                timeout: 60000
            });

            // Wait for form to be ready
            await page.waitForSelector('form', { timeout: 10000 });
        } catch (error) {
            console.error('Setup error:', error);
            throw error;
        }
    });

    beforeEach(async () => {
        try {
            // Reload page instead of resetting form state
            await page.reload({ waitUntil: 'domcontentloaded', timeout: 30000 });
            await page.waitForSelector('form', { timeout: 10000 });
        } catch (error) {
            console.error('beforeEach error:', error);
            throw error;
        }
    });

    afterAll(async () => {
        await browser.close();
    });

    // Test cases
    test('Form loads with required fields', async () => {
        const requiredFields = await page.evaluate(() => {
            return Array.from(document.querySelectorAll('[required]')).map(el => ({
                name: el.name,
                type: el.type || el.tagName.toLowerCase(),
                id: el.id
            }));
        });
        console.log('Required fields:', requiredFields);
        expect(requiredFields.length).toBeGreaterThan(0);
    }, 60000);

    test('Empty required fields show validation', async () => {
        try {
            // Find submit button
            const submitButton = await page.$('#reg_form_button');
            expect(submitButton).toBeTruthy();

            // Click submit and wait for validation
            await submitButton.evaluate(button => button.click());
            await page.waitForTimeout(1000);

            // Check validation state
            const validationState = await page.evaluate(() => {
                const invalidFields = document.querySelectorAll('[required]:invalid');
                const errorMessages = document.querySelectorAll('.error:not(:empty), .invalid-feedback:not(:empty)');
                
                return {
                    invalidCount: invalidFields.length,
                    errorCount: errorMessages.length,
                    invalidFieldNames: Array.from(invalidFields, field => field.name),
                    errorMessages: Array.from(errorMessages, msg => msg.textContent.trim())
                };
            });

            console.log('Validation state:', validationState);
            expect(validationState.invalidCount + validationState.errorCount).toBeGreaterThan(0);
        } catch (error) {
            console.error('Validation test error:', error);
            throw error;
        }
    }, 60000);

    test('CR number validation', async () => {
        try {
            // Type invalid CR number
            await page.type('input[name="cr_number"]', '123');
            
            // Click submit and wait for validation
            const submitButton = await page.$('#reg_form_button');
            await submitButton.evaluate(button => button.click());
            await page.waitForTimeout(1000);

            // Check validation
            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="cr_number"]');
                const error = document.querySelector('#cr_number_error, [class*="cr_number"][class*="error"]');
                const errorSpan = document.querySelector('[data-valmsg-for="cr_number"]');
                
                return {
                    value: input.value,
                    valid: input.value.length === 12, // CR number should be 12 digits
                    errorMessage: error ? error.textContent.trim() : '',
                    spanError: errorSpan ? errorSpan.textContent.trim() : '',
                    hasErrorClass: input.classList.contains('error') || 
                                 input.classList.contains('is-invalid') ||
                                 input.classList.contains('input-validation-error')
                };
            });

            console.log('CR validation:', validation);
            expect(validation.valid || validation.errorMessage || validation.spanError || validation.hasErrorClass).toBeFalsy();
        } catch (error) {
            console.error('CR validation error:', error);
            throw error;
        }
    }, 60000);

    test('Email validation', async () => {
        try {
            // Type invalid email
            await page.type('input[name="user_email"]', 'invalid-email');
            
            // Click submit and wait for validation
            const submitButton = await page.$('#reg_form_button');
            await submitButton.evaluate(button => button.click());
            await page.waitForTimeout(1000);

            // Check validation
            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="user_email"]');
                const error = document.querySelector('#user_email_error, [class*="email"][class*="error"]');
                const errorSpan = document.querySelector('[data-valmsg-for="user_email"]');
                
                // Basic email validation regex
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                return {
                    value: input.value,
                    valid: emailRegex.test(input.value),
                    errorMessage: error ? error.textContent.trim() : '',
                    spanError: errorSpan ? errorSpan.textContent.trim() : '',
                    hasErrorClass: input.classList.contains('error') || 
                                 input.classList.contains('is-invalid') ||
                                 input.classList.contains('input-validation-error')
                };
            });

            console.log('Email validation:', validation);
            expect(validation.valid || validation.errorMessage || validation.spanError || validation.hasErrorClass).toBeFalsy();
        } catch (error) {
            console.error('Email validation error:', error);
            throw error;
        }
    }, 60000);

    test('Riyada certificate visibility', async () => {
        try {
            const toggleResult = await page.evaluate(() => {
                const select = document.querySelector('select[name="riyada_certificate"]');
                const expContainer = document.getElementById('expiry_date_container');
                const docContainer = document.getElementById('documents_container');
                
                if (!select || !expContainer || !docContainer) return null;

                // Test Yes
                select.value = 'Yes';
                select.dispatchEvent(new Event('change'));
                
                const afterYes = {
                    expiry: window.getComputedStyle(expContainer).display,
                    documents: window.getComputedStyle(docContainer).display
                };

                // Test No
                select.value = 'No';
                select.dispatchEvent(new Event('change'));
                
                const afterNo = {
                    expiry: window.getComputedStyle(expContainer).display,
                    documents: window.getComputedStyle(docContainer).display
                };

                return { afterYes, afterNo };
            });

            console.log('Toggle results:', toggleResult);
            expect(toggleResult).not.toBeNull();
            expect(toggleResult.afterYes.expiry !== toggleResult.afterNo.expiry).toBeTruthy();
        } catch (error) {
            console.error('Riyada certificate error:', error);
            throw error;
        }
    }, 60000);
}); 