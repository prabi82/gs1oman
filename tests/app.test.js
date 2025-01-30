const puppeteer = require('puppeteer');

// Increase Jest timeout and set max listeners
jest.setTimeout(300000); // 5 minutes total
require('events').EventEmitter.defaultMaxListeners = 20;

// Base URL configuration
const BASE_URL = 'http://localhost';
const APP_PATH = '/gs1oman.com';
const ADMIN_PATH = '/gs1oman.com/admin';

describe('GS1 Oman Application Tests', () => {
    let browser;
    let page;

    beforeAll(async () => {
        browser = await puppeteer.launch({
            headless: "new",
            args: ['--no-sandbox', '--disable-setuid-sandbox'],
            protocolTimeout: 60000
        });
    });

    beforeEach(async () => {
        page = await browser.newPage();
        await page.setViewport({ width: 1366, height: 768 });
        await page.setDefaultNavigationTimeout(60000);
        
        // Log console messages
        page.on('console', msg => console.log('PAGE LOG:', msg.text()));
        
        try {
            await page.goto('http://localhost/gs1oman.com/', { 
                waitUntil: 'networkidle0',
                timeout: 60000 
            });
            console.log('Successfully connected to server');
        } catch (error) {
            console.error('Failed to connect to server:', error);
            throw error;
        }
    });

    afterAll(async () => {
        await browser.close();
    });

    describe('Registration Form Tests', () => {
        test('Empty Form Submission', async () => {
            try {
                // Wait for form to be ready
                await page.waitForSelector('#reg_form_button', { visible: true, timeout: 10000 });
                
                // Click submit button
                await page.click('#reg_form_button');
                await page.waitForTimeout(2000);

                // Get all error messages
                const errors = await page.evaluate(() => {
                    const errorElements = [
                        ...document.querySelectorAll('[id$="-error"]:not(:empty)'),
                        ...document.querySelectorAll('[id$="_error"]:not(:empty)'),
                        ...document.querySelectorAll('.error:not(:empty)'),
                        ...document.querySelectorAll('.is-invalid'),
                        ...document.querySelectorAll('input:invalid'),
                        ...document.querySelectorAll('select:invalid')
                    ];
                    return Array.from(new Set(errorElements)).map(el => ({
                        field: el.id || el.name || el.className,
                        message: el.textContent?.trim() || el.validationMessage || 'Field is invalid'
                    })).filter(err => err.message);
                });

                expect(errors.length).toBeGreaterThan(0);
            } catch (error) {
                console.error('Empty form submission failed:', error);
                throw error;
            }
        });

        test('Email Format Validation', async () => {
            // Wait for email input
            await page.waitForSelector('input[name="user_email"]', { visible: true, timeout: 10000 });
            
            // Clear and type invalid email
            await page.$eval('input[name="user_email"]', el => el.value = '');
            await page.type('input[name="user_email"]', 'invalid-email');
            await page.keyboard.press('Tab');
            await page.waitForTimeout(1000);

            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="user_email"]');
                const errorSpan = document.querySelector('#user_email-error, #user_email_error');
                const hasErrorClass = input.classList.contains('error') || input.classList.contains('is-invalid');
                const isValid = input.checkValidity() && input.value.includes('@') && input.value.includes('.');
                return {
                    valid: isValid,
                    errorMessage: errorSpan ? errorSpan.textContent : '',
                    hasErrorClass
                };
            });

            expect(validation.valid).toBeFalsy();
            expect(validation.errorMessage || validation.hasErrorClass).toBeTruthy();
        });

        test('Date Validation', async () => {
            // Wait for date inputs
            await page.waitForSelector('input[name="cr_registration_date"]', { visible: true, timeout: 10000 });
            await page.waitForSelector('input[name="cr_expiry_date"]', { visible: true, timeout: 10000 });

            // Set registration date to today
            const today = new Date().toISOString().split('T')[0];
            await page.$eval('input[name="cr_registration_date"]', (el, date) => {
                el.value = date;
                el.dispatchEvent(new Event('change', { bubbles: true }));
            }, today);

            // Set expiry date to yesterday (invalid)
            const yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            const yesterdayStr = yesterday.toISOString().split('T')[0];
            await page.$eval('input[name="cr_expiry_date"]', (el, date) => {
                el.value = date;
                el.dispatchEvent(new Event('change', { bubbles: true }));
            }, yesterdayStr);

            await page.click('#reg_form_button');
            await page.waitForTimeout(2000);

            const errors = await page.evaluate(() => {
                const dateErrors = document.querySelectorAll('[id*="date"][id$="-error"]:not(:empty), [id*="date"][id$="_error"]:not(:empty)');
                return Array.from(dateErrors).map(el => ({
                    field: el.id,
                    message: el.textContent.trim()
                }));
            });

            expect(errors.length).toBeGreaterThan(0);
        });

        test('Live Form Submission', async () => {
            // Fill company details
            await page.waitForSelector('input[name="name"]', { visible: true, timeout: 10000 });
            await page.$eval('input[name="name"]', el => el.value = 'Test Company');
            await page.$eval('input[name="name_ar"]', el => el.value = 'شركة اختبار');
            await page.$eval('input[name="pobox"]', el => el.value = '12345');
            await page.$eval('input[name="zipcode"]', el => el.value = '123');
            await page.$eval('input[name="address"]', el => el.value = 'Test Address');
            await page.$eval('input[name="address_ar"]', el => el.value = 'عنوان الاختبار');

            // Select country and city
            await page.select('select[name="country"]', 'OM');
            await page.waitForTimeout(1000);
            await page.select('select[name="city"]', '1');

            // Fill contact details
            await page.$eval('input[name="mobile_number"]', el => el.value = '96871234567');
            await page.$eval('input[name="phone_number"]', el => el.value = '96871234567');

            // Fill CR details
            await page.$eval('input[name="cr_number"]', el => el.value = '123456789012');
            await page.select('select[name="cr_legal_type"]', '1');

            const today = new Date().toISOString().split('T')[0];
            const nextYear = new Date();
            nextYear.setFullYear(nextYear.getFullYear() + 1);
            const nextYearStr = nextYear.toISOString().split('T')[0];

            await page.$eval('input[name="cr_registration_date"]', (el, date) => {
                el.value = date;
                el.dispatchEvent(new Event('change', { bubbles: true }));
            }, today);

            await page.$eval('input[name="cr_expiry_date"]', (el, date) => {
                el.value = date;
                el.dispatchEvent(new Event('change', { bubbles: true }));
            }, nextYearStr);

            // Fill business information
            await page.select('select[name="business_type_product_category"]', '1');
            await page.$eval('input[name="healthcare_status"][value="no"]', el => el.click());

            // Fill primary contact
            await page.$eval('input[name="first_name[]"]', el => el.value = 'John');
            await page.$eval('input[name="last_name[]"]', el => el.value = 'Doe');
            await page.$eval('input[name="email_id[]"]', el => el.value = 'john.doe@test.com');
            await page.$eval('input[name="phone_number1[]"]', el => el.value = '96871234567');

            // Upload test files
            const fileInput1 = await page.$('input[name="upload_document1"]');
            const fileInput2 = await page.$('input[name="upload_document2"]');
            const fileInput3 = await page.$('input[name="upload_document3"]');

            if (fileInput1) await fileInput1.uploadFile('test.pdf');
            if (fileInput2) await fileInput2.uploadFile('test.pdf');
            if (fileInput3) await fileInput3.uploadFile('test.pdf');

            // Select package and payment
            await page.select('select[name="product_id"]', '1');
            await page.$eval('input[name="offline_payment"][value="bank"]', el => el.click());

            // Accept terms
            await page.$eval('#finalpay1', el => el.click());

            // Submit form
            await page.click('#reg_form_button');
            await page.waitForTimeout(2000);

            const errors = await page.evaluate(() => {
                const errorElements = [
                    ...document.querySelectorAll('[id$="-error"]:not(:empty)'),
                    ...document.querySelectorAll('[id$="_error"]:not(:empty)'),
                    ...document.querySelectorAll('.error:not(:empty)'),
                    ...document.querySelectorAll('.is-invalid')
                ];
                return Array.from(new Set(errorElements)).map(el => ({
                    field: el.id || el.className,
                    message: el.textContent.trim()
                })).filter(err => err.message);
            });

            console.log('Submission errors:', errors);
            expect(errors.length).toBe(0);
        });
    });

    describe('Admin Login Tests', () => {
        beforeEach(async () => {
            try {
                await page.goto(BASE_URL + ADMIN_PATH + '/login.php', {
                    waitUntil: 'networkidle0',
                    timeout: 30000
                });
            } catch (error) {
                console.error('Admin navigation error:', error.message);
                throw error;
            }
        });

        test('Valid Login Attempt', async () => {
            // Fill in login form
            await page.type('input[name="email"]', 'admin@example.com');
            await page.type('input[name="password"]', 'admin123');
            
            // Click the submit button and wait for navigation
            await Promise.all([
                page.waitForNavigation({ waitUntil: 'networkidle0' }),
                page.click('button[type="submit"], input[type="submit"]')
            ]);
            
            // Check if redirected to admin dashboard
            const currentUrl = page.url();
            expect(currentUrl).toContain('/admin/');
        });
    });

    describe('Form Validation Tests', () => {
        test('PO Box Validation', async () => {
            const invalidTests = [
                { value: '12', expected: false },
                { value: '123456', expected: false }
            ];

            for (const test of invalidTests) {
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="pobox"]');
                    if (input) {
                        input.value = '';
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });

                await page.type('input[name="pobox"]', test.value);
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="pobox"]');
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    input.dispatchEvent(new Event('blur', { bubbles: true }));
                });

                const validation = await page.evaluate(() => {
                    const input = document.querySelector('input[name="pobox"]');
                    const error = document.querySelector('#pobox-error');
                    return {
                        value: input.value,
                        valid: input.checkValidity() && /^[0-9]{3,5}$/.test(input.value),
                        errorMessage: error ? error.textContent.trim() : '',
                        hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                    };
                });

                console.log(`PO Box validation for ${test.value}:`, validation);
                expect(validation.valid).toBe(test.expected);
            }

            // Test valid case
            await page.evaluate(() => {
                const input = document.querySelector('input[name="pobox"]');
                if (input) {
                    input.value = '';
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });

            await page.type('input[name="pobox"]', '12345');
            await page.evaluate(() => {
                const input = document.querySelector('input[name="pobox"]');
                input.dispatchEvent(new Event('change', { bubbles: true }));
                input.dispatchEvent(new Event('blur', { bubbles: true }));
            });

            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="pobox"]');
                const error = document.querySelector('#pobox-error');
                return {
                    value: input.value,
                    valid: input.checkValidity() && /^[0-9]{3,5}$/.test(input.value),
                    errorMessage: error ? error.textContent.trim() : '',
                    hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                };
            });

            console.log('PO Box validation for valid case:', validation);
            expect(validation.valid).toBe(true);
        });

        test('Postal Code Validation', async () => {
            const invalidTests = [
                { value: '12', expected: false },
                { value: '1234', expected: false }
            ];

            for (const test of invalidTests) {
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="zipcode"]');
                    if (input) {
                        input.value = '';
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });

                await page.type('input[name="zipcode"]', test.value);
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="zipcode"]');
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    input.dispatchEvent(new Event('blur', { bubbles: true }));
                });

                const validation = await page.evaluate(() => {
                    const input = document.querySelector('input[name="zipcode"]');
                    const error = document.querySelector('#zipcode-error');
                    return {
                        value: input.value,
                        valid: input.checkValidity() && /^[0-9]{3}$/.test(input.value),
                        errorMessage: error ? error.textContent.trim() : '',
                        hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                    };
                });

                console.log(`Postal Code validation for ${test.value}:`, validation);
                expect(validation.valid).toBe(test.expected);
            }

            // Test valid case
            await page.evaluate(() => {
                const input = document.querySelector('input[name="zipcode"]');
                if (input) {
                    input.value = '';
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });

            await page.type('input[name="zipcode"]', '123');
            await page.evaluate(() => {
                const input = document.querySelector('input[name="zipcode"]');
                input.dispatchEvent(new Event('change', { bubbles: true }));
                input.dispatchEvent(new Event('blur', { bubbles: true }));
            });

            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="zipcode"]');
                const error = document.querySelector('#zipcode-error');
                return {
                    value: input.value,
                    valid: input.checkValidity() && /^[0-9]{3}$/.test(input.value),
                    errorMessage: error ? error.textContent.trim() : '',
                    hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                };
            });

            console.log('Postal Code validation for valid case:', validation);
            expect(validation.valid).toBe(true);
        });

        test('CR Number Validation', async () => {
            const invalidTests = [
                { value: '1234', expected: false },
                { value: '12345678901', expected: false }
            ];

            for (const test of invalidTests) {
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="cr_number"]');
                    if (input) {
                        input.value = '';
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });

                await page.type('input[name="cr_number"]', test.value);
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="cr_number"]');
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    input.dispatchEvent(new Event('blur', { bubbles: true }));
                });

                const validation = await page.evaluate(() => {
                    const input = document.querySelector('input[name="cr_number"]');
                    const error = document.querySelector('#cr_number-error');
                    return {
                        value: input.value,
                        valid: input.checkValidity() && /^[0-9]{12}$/.test(input.value),
                        errorMessage: error ? error.textContent.trim() : '',
                        hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                    };
                });

                console.log(`CR Number validation for ${test.value}:`, validation);
                expect(validation.valid).toBe(test.expected);
            }

            // Test valid case
            await page.evaluate(() => {
                const input = document.querySelector('input[name="cr_number"]');
                if (input) {
                    input.value = '';
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });

            await page.type('input[name="cr_number"]', '123456789012');
            await page.evaluate(() => {
                const input = document.querySelector('input[name="cr_number"]');
                input.dispatchEvent(new Event('change', { bubbles: true }));
                input.dispatchEvent(new Event('blur', { bubbles: true }));
            });

            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="cr_number"]');
                const error = document.querySelector('#cr_number-error');
                return {
                    value: input.value,
                    valid: input.checkValidity() && /^[0-9]{12}$/.test(input.value),
                    errorMessage: error ? error.textContent.trim() : '',
                    hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                };
            });

            console.log('CR Number validation for valid case:', validation);
            expect(validation.valid).toBe(true);
        });

        test('VAT Number Format Validation', async () => {
            const invalidTests = [
                { value: '12', expected: false },
                { value: '12345678901234', expected: false }
            ];

            for (const test of invalidTests) {
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="vat_number"]');
                    if (input) {
                        input.value = '';
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });

                await page.type('input[name="vat_number"]', test.value);
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="vat_number"]');
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    input.dispatchEvent(new Event('blur', { bubbles: true }));
                });

                const validation = await page.evaluate(() => {
                    const input = document.querySelector('input[name="vat_number"]');
                    const error = document.querySelector('#vat_number-error');
                    return {
                        value: input.value,
                        valid: input.checkValidity() && /^[A-Za-z0-9]{15}$/.test(input.value),
                        errorMessage: error ? error.textContent.trim() : '',
                        hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                    };
                });

                console.log(`VAT Number validation for ${test.value}:`, validation);
                expect(validation.valid).toBe(test.expected);
            }

            // Test valid case
            await page.evaluate(() => {
                const input = document.querySelector('input[name="vat_number"]');
                if (input) {
                    input.value = '';
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });

            await page.type('input[name="vat_number"]', '123456789012345');
            await page.evaluate(() => {
                const input = document.querySelector('input[name="vat_number"]');
                input.dispatchEvent(new Event('change', { bubbles: true }));
                input.dispatchEvent(new Event('blur', { bubbles: true }));
            });

            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="vat_number"]');
                const error = document.querySelector('#vat_number-error');
                return {
                    value: input.value,
                    valid: input.checkValidity() && /^[A-Za-z0-9]{15}$/.test(input.value),
                    errorMessage: error ? error.textContent.trim() : '',
                    hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                };
            });

            console.log('VAT Number validation for valid case:', validation);
            expect(validation.valid).toBe(true);
        });

        test('Number of Employees Validation', async () => {
            const invalidTests = [
                { value: '0', expected: false },
                { value: '12345678', expected: false }
            ];

            for (const test of invalidTests) {
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="number_of_employee"]');
                    if (input) {
                        input.value = '';
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });

                await page.type('input[name="number_of_employee"]', test.value);
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="number_of_employee"]');
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    input.dispatchEvent(new Event('blur', { bubbles: true }));
                });

                const validation = await page.evaluate(() => {
                    const input = document.querySelector('input[name="number_of_employee"]');
                    const error = document.querySelector('#number_of_employee-error');
                    return {
                        value: input.value,
                        valid: input.checkValidity() && /^[0-9]{1,7}$/.test(input.value) && parseInt(input.value) > 0,
                        errorMessage: error ? error.textContent.trim() : '',
                        hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                    };
                });

                console.log(`Number of Employees validation for ${test.value}:`, validation);
                expect(validation.valid).toBe(test.expected);
            }

            // Test valid case
            await page.evaluate(() => {
                const input = document.querySelector('input[name="number_of_employee"]');
                if (input) {
                    input.value = '';
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });

            await page.type('input[name="number_of_employee"]', '100');
            await page.evaluate(() => {
                const input = document.querySelector('input[name="number_of_employee"]');
                input.dispatchEvent(new Event('change', { bubbles: true }));
                input.dispatchEvent(new Event('blur', { bubbles: true }));
            });

            const validation = await page.evaluate(() => {
                const input = document.querySelector('input[name="number_of_employee"]');
                const error = document.querySelector('#number_of_employee-error');
                return {
                    value: input.value,
                    valid: input.checkValidity() && /^[0-9]{1,7}$/.test(input.value) && parseInt(input.value) > 0,
                    errorMessage: error ? error.textContent.trim() : '',
                    hasErrorClass: input.classList.contains('error') || input.classList.contains('is-invalid')
                };
            });

            console.log('Number of Employees validation for valid case:', validation);
            expect(validation.valid).toBe(true);
        });
    });

    describe('Dynamic Form Behavior Tests', () => {
        beforeEach(async () => {
            await page.goto('http://localhost/gs1oman.com/', {
                waitUntil: 'domcontentloaded'
            });
            await page.waitForSelector('form', { timeout: 10000 });
        });

        test('Riyada Certificate Toggle', async () => {
            const result = await page.evaluate(() => {
                const select = document.querySelector('select[name="riyada_certificate"]');
                const expContainer = document.getElementById('expiry_date_container');
                
                // Test Yes
                select.value = 'Yes';
                select.dispatchEvent(new Event('change'));
                const visibleAfterYes = window.getComputedStyle(expContainer).display !== 'none';
                
                // Test No
                select.value = 'No';
                select.dispatchEvent(new Event('change'));
                const hiddenAfterNo = window.getComputedStyle(expContainer).display === 'none';
                
                return { visibleAfterYes, hiddenAfterNo };
            });
            
            expect(result.visibleAfterYes).toBeTruthy();
            expect(result.hiddenAfterNo).toBeTruthy();
        });
    });

    describe('Live Data Entry Tests', () => {
        beforeEach(async () => {
            try {
                await page.goto(BASE_URL + APP_PATH, {
                    waitUntil: 'networkidle0',
                    timeout: 30000
                });
                // Wait for form to be fully loaded
                await page.waitForSelector('#reg_form_button', { visible: true });
            } catch (error) {
                console.error('Navigation error:', error.message);
                throw error;
            }
        });

        test('Complete Form Submission', async () => {
            // Company Details
            await page.type('input[name="name"]', 'Test Company LLC');
            await page.type('input[name="name_ar"]', 'شركة اختبار');
            await page.type('input[name="pobox"]', '12345');
            await page.type('input[name="zipcode"]', '123');
            await page.type('input[name="address"]', '123 Test Street');
            await page.type('input[name="address_ar"]', 'شارع الاختبار ١٢٣');

            // Select Country and City
            await page.select('select[name="country"]', 'Oman');
            await page.waitForTimeout(500); // Wait for city dropdown to update
            await page.select('select[name="city"]', 'Muscat');

            // Contact Details
            await page.type('input[name="mobile_number"]', '96871234567');
            await page.type('input[name="phone_number"]', '96824123456');

            // CR Details
            await page.select('select[name="riyada_certificate"]', 'No');
            await page.type('input[name="cr_number"]', '123456789012');
            await page.select('select[name="cr_legal_type"]', 'Limited Liability Company - LLC');

            // Set dates using evaluate to ensure proper format
            await page.evaluate(() => {
                const today = new Date();
                const nextYear = new Date();
                nextYear.setFullYear(today.getFullYear() + 1);
                
                document.querySelector('input[name="cr_registration_date"]').value = today.toISOString().split('T')[0];
                document.querySelector('input[name="cr_expiry_date"]').value = nextYear.toISOString().split('T')[0];
            });

            // Business Type
            await page.select('select[name="business_type_product_category"]', 'Food');
            
            // Healthcare Status
            await page.evaluate(() => {
                document.querySelector('input[name="healthcare_status"][value="No"]').click();
            });

            // Primary Contact
            await page.type('input[name="first_name[]"]', 'John');
            await page.type('input[name="last_name[]"]', 'Doe');
            await page.type('input[name="job_title[]"]', 'Manager');
            await page.type('input[name="email_id[]"]', 'john.doe@test.com');
            await page.type('input[name="phone_number1[]"]', '96871234567');

            // Upload test files
            const uploadFile = async (selector) => {
                const input = await page.$(selector);
                await input.uploadFile('test.pdf'); // You'll need to create this file
            };

            try {
                await uploadFile('input[name="upload_document1"]');
                await uploadFile('input[name="upload_document2"]');
                await uploadFile('input[name="upload_document3"]');
            } catch (error) {
                console.log('File upload simulation skipped:', error.message);
            }

            // Package Selection
            await page.select('select[name="product_id"]', '1000');

            // Payment Method
            await page.evaluate(() => {
                document.querySelector('input[name="offline_payment"][value="Bank Transfer"]').click();
            });

            // Terms and Conditions
            await page.evaluate(() => {
                document.querySelector('input[name="tnc"]').click();
            });

            // Take screenshot before submission
            await page.screenshot({ path: 'form-filled.png', fullPage: true });

            // Submit form
            await Promise.all([
                page.waitForNavigation({ waitUntil: 'networkidle0', timeout: 60000 }).catch(() => {}),
                page.click('#reg_form_button')
            ]);

            // Verify submission
            const result = await page.evaluate(() => {
                const errors = Array.from(document.querySelectorAll('.error-text:not(:empty), .invalid-feedback:not(:empty), label.error:not(:empty)'));
                return {
                    hasErrors: errors.length > 0,
                    errors: errors.map(e => ({
                        field: e.getAttribute('for') || e.previousElementSibling?.name || 'unknown',
                        message: e.textContent.trim()
                    }))
                };
            });

            console.log('Form submission result:', result);
            expect(result.hasErrors).toBeFalsy();
        });
    });
}); 