import puppeteer from 'puppeteer';

// Helper functions for generating random data
function generateRandomString(length = 8) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return Array.from({length}, () => chars[Math.floor(Math.random() * chars.length)]).join('');
}

function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function generateRandomEmail() {
    return `test.${generateRandomString(8)}@example.com`;
}

function generateRandomPhone() {
    return `968 ${generateRandomNumber(1000, 9999)} ${generateRandomNumber(1000, 9999)}`;
}

function generateRandomCRNumber() {
    return Array.from({length: 12}, () => generateRandomNumber(0, 9)).join('');
}

function generateRandomArabicName() {
    const arabicNames = ['شركة', 'مؤسسة', 'مجموعة'];
    const arabicAdjectives = ['التجارية', 'العالمية', 'المتحدة', 'الدولية'];
    return `${arabicNames[Math.floor(Math.random() * arabicNames.length)]} ${generateRandomString(5)} ${arabicAdjectives[Math.floor(Math.random() * arabicAdjectives.length)]}`;
}

function generateRandomCompanyName() {
    const prefixes = ['Global', 'International', 'United', 'Advanced', 'Premium'];
    const suffixes = ['Trading', 'Solutions', 'Services', 'Group', 'Corporation'];
    return `${prefixes[Math.floor(Math.random() * prefixes.length)]} ${generateRandomString(5)} ${suffixes[Math.floor(Math.random() * suffixes.length)]}`;
}

function generateRandomAddress() {
    return `Building ${generateRandomNumber(100, 999)}, Way ${generateRandomNumber(1000, 9999)}, Block ${generateRandomNumber(100, 999)}`;
}

async function fillFormWithRandomData(page) {
    console.log('Form data entries:');
    
    // Reset all select elements to their default state first
    await page.evaluate(() => {
        document.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
            if (typeof jQuery !== 'undefined') {
                jQuery(select).trigger('change');
            }
        });
    });

    // Handle Riyada certificate
    console.log('Setting up Riyada certificate handling...');
await page.evaluate(() => {
        const riyadaSelect = document.querySelector('select[name="riyada_certificate"]');
        if (riyadaSelect) {
            riyadaSelect.value = 'Yes';
            if (typeof jQuery !== 'undefined') {
                jQuery(riyadaSelect).trigger('change');
            }
        }
        console.log('Riyada certificate value set to:', riyadaSelect ? riyadaSelect.value : 'not found');
    });

    // Wait for conditional fields to appear
    await new Promise(resolve => setTimeout(resolve, 1000));

    // Generate random data in Node.js context
    const randomData = {
        name: generateRandomCompanyName(),
        name_ar: generateRandomArabicName(),
        pobox: generateRandomNumber(10000, 99999).toString(),
        zipcode: generateRandomNumber(100, 999).toString(),
        address: `Building ${generateRandomNumber(100, 999)}, Way ${generateRandomNumber(1000, 9999)}, Block ${generateRandomNumber(100, 999)}`,
        address_ar: `Building ${generateRandomNumber(100, 999)}, Way ${generateRandomNumber(1000, 9999)}, Block ${generateRandomNumber(100, 999)}`,
        country: 'Oman',
        city: 'Muscat',
        mobile_number: `968 ${generateRandomNumber(1000, 9999)} ${generateRandomNumber(1000, 9999)}`,
        phone_number: `968 ${generateRandomNumber(1000, 9999)} ${generateRandomNumber(1000, 9999)}`,
        fax_number: `968 ${generateRandomNumber(1000, 9999)} ${generateRandomNumber(1000, 9999)}`,
        cr_number: generateRandomNumber(100000000000, 999999999999).toString(),
        cr_legal_type: 'Limited Liability Company - LLC',
        user_email: generateRandomEmail(),
        number_of_employee: generateRandomNumber(50, 500).toString(),
        riyada_certificate: 'Yes',
        exp_date: '2026-01-28',
        // Add CR dates
        cr_registration_date: new Date().toISOString().split('T')[0],
        cr_expiry_date: new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
        // Add business type product category
        business_type_product_category: 'Food',
        // Add contact person details
        'title[]': ['Mr.', 'Mr.'],
        'first_name[]': ['John', 'David'],
        'last_name[]': ['Smith', 'Johnson'],
        'job_title[]': ['CEO', 'Manager'],
        'email_id[]': [generateRandomEmail(), generateRandomEmail()],
        'phone_number1[]': [generateRandomPhone(), generateRandomPhone()]
    };

    // Now fill in all form fields including conditional ones
    await page.evaluate((formData) => {
        // Fill regular form fields
        Object.entries(formData).forEach(([name, value]) => {
            if (Array.isArray(value)) {
                // Handle array fields (contact persons)
                const fields = document.querySelectorAll(`[name="${name}"]`);
                fields.forEach((field, index) => {
                    if (index < value.length) {
                        field.value = value[index];
                        if (field.tagName === 'SELECT' && typeof jQuery !== 'undefined') {
                            jQuery(field).trigger('change');
                        }
                    }
                });
            } else {
                const field = document.querySelector(`[name="${name}"]`);
                if (field) {
                    if (field.tagName === 'SELECT') {
                        field.value = value;
                        if (typeof jQuery !== 'undefined') {
                            jQuery(field).trigger('change');
                        }
    } else {
                        field.value = value;
                    }
                    console.log(`${name}: ${field.value}`);
                }
            }
        });

        // Handle healthcare radio buttons
        const healthcareNo = document.querySelector('input[name="healthcare_status"][value="NO"]');
        if (healthcareNo) {
            healthcareNo.checked = true;
            if (typeof jQuery !== 'undefined') {
                jQuery(healthcareNo).trigger('change');
            }
        }

        // Get form data for logging
        const form = document.querySelector('form[name="listForm"]');
        if (form) {
            const formDataObj = new FormData(form);
            for (let [key, value] of formDataObj.entries()) {
                console.log(`${key}: ${value}`);
            }
        }
    }, randomData);

    // Wait for any animations or dynamic content to load
    await new Promise(resolve => setTimeout(resolve, 1000));

    // Handle all file uploads
    await page.evaluate(() => {
        const fileInputs = {
            'upload_document1': 'cr_document.pdf',
            'upload_document2': 'vat_certificate.pdf',
            'upload_document3': 'other_document.pdf',
            'documents_req': 'riyada_cert.pdf',
            'commercial_reg': 'commercial_registration.pdf'
        };

        Object.entries(fileInputs).forEach(([inputName, fileName]) => {
            const input = document.querySelector(`input[name="${inputName}"]`);
            if (input) {
                const file = new File(['test'], fileName, { type: 'application/pdf' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;
                if (typeof jQuery !== 'undefined') {
                    jQuery(input).trigger('change');
                } else {
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
        });
    });

    // Wait for file upload handling
    await new Promise(resolve => setTimeout(resolve, 1000));

    // Verify the fields are set correctly
    const formData = await page.evaluate(() => {
        const data = {
            riyada_certificate: document.querySelector('select[name="riyada_certificate"]')?.value,
            exp_date: document.querySelector('input[name="exp_date"]')?.value,
            documents_req: document.querySelector('input[name="documents_req"]')?.files?.[0]?.name
        };
        console.log('Riyada certificate data:', JSON.stringify(data));
        return data;
    });

    return randomData;
}

// Main test function
async function runTest(testNumber) {
    let browser;
    let page;
    let formData;
    
    try {
        console.log(`\nStarting Test #${testNumber}`);
        
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });

        page = await browser.newPage();
        
        // Add console logging
        page.on('console', msg => console.log(`Test #${testNumber} Browser console:`, msg.text()));
        page.on('dialog', async dialog => {
            console.log(`Test #${testNumber} Dialog:`, dialog.message());
            await dialog.accept();
        });

        // Enable request/response logging
        page.on('request', request => {
            if (request.method() === 'POST') {
                console.log(`Test #${testNumber} Request URL:`, request.url());
                console.log(`Test #${testNumber} Request headers:`, request.headers());
            }
        });
        
        page.on('response', async response => {
            if (response.request().method() === 'POST') {
                console.log(`Test #${testNumber} Response status:`, response.status());
                try {
                    const text = await response.text();
                    console.log(`Test #${testNumber} Response body:`, text.substring(0, 500));
                } catch (e) {
                    console.log(`Test #${testNumber} Could not get response body:`, e.message);
                }
            }
        });

        await page.goto('http://localhost/gs1oman.com/index.php', {
            waitUntil: 'networkidle0',
            timeout: 60000
        });

        await page.waitForSelector('form[name="listForm"]', { timeout: 10000 });
        console.log(`Test #${testNumber}: Form found, filling with random data...`);

        const randomData = await fillFormWithRandomData(page);
        console.log(`Test #${testNumber} Random data:`, randomData);

        // Select package
        console.log(`Test #${testNumber}: Selecting package...`);
        await page.waitForSelector('select#product_id', { timeout: 10000 });
        
await page.evaluate(() => {
            const packageSelect = document.querySelector('select#product_id');
            if (!packageSelect) {
                throw new Error('Package select element not found');
            }

            packageSelect.value = '3';
            packageSelect.dispatchEvent(new Event('change', { bubbles: true }));
            console.log('Selected package:', packageSelect.value);
            
            if (typeof show_package_details === 'function') {
                show_package_details();
            }
        });

        // Wait for package details
        console.log(`Test #${testNumber}: Waiting for package details...`);
        await page.waitForFunction(() => {
            const resultData = document.querySelector('.product_result_data');
            return resultData && resultData.innerHTML.trim() !== '';
        }, { timeout: 20000 });

        // Bypass reCAPTCHA
        console.log(`Test #${testNumber}: Bypassing reCAPTCHA...`);
        await page.evaluate(() => {
            const recaptchaResponse = document.createElement('textarea');
            recaptchaResponse.id = 'g-recaptcha-response';
            recaptchaResponse.value = 'BYPASS_VALUE_FOR_TESTING';
            document.querySelector('form[name="listForm"]').appendChild(recaptchaResponse);
        });

        // Submit form
        console.log(`Test #${testNumber}: Submitting form...`);
        const formSubmissionPromise = page.evaluate(() => {
            return new Promise((resolve, reject) => {
                const form = document.querySelector('form[name="listForm"]');
                if (!form) {
                    reject('Form not found');
                    return;
                }

                // Add submit field
                const submitInput = document.createElement('input');
                submitInput.type = 'hidden';
                submitInput.name = 'submit';
                submitInput.value = '1';
                form.appendChild(submitInput);

                // Create FormData and log it
                const formData = new FormData(form);
                console.log('Form data entries:');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                // Submit using fetch
                fetch(form.action || window.location.href, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.text())
                .then(text => {
                    console.log('Server response:', text);
                    try {
                        const jsonResponse = JSON.parse(text);
                        if (jsonResponse.success) {
                            resolve('success');
                        } else {
                            reject('Form submission failed: ' + jsonResponse.message);
                        }
                    } catch (e) {
                        if (text.includes('thanks.php') || text.includes('success')) {
                            resolve('success');
                        } else {
                            reject('Form submission failed: Invalid response format');
                        }
                    }
                })
                .catch(error => {
                    reject('Form submission error: ' + error);
                });
            });
        });

        // Wait for submission response
        try {
            await Promise.race([
                formSubmissionPromise,
                page.waitForNavigation({ timeout: 30000 }),
                page.waitForSelector('.success-message, .thankyou-page, #successMessage', { timeout: 30000 }),
                page.waitForFunction(
                    () => window.location.href.includes('thanks.php'),
                    { timeout: 30000 }
                )
            ]);
            
            // Log final page state
            const url = await page.url();
            console.log(`Test #${testNumber} Final URL:`, url);
            
            const content = await page.content();
            console.log(`Test #${testNumber} Final page content:`, content.substring(0, 500));
            
            console.log(`Test #${testNumber} completed successfully`);
            return { success: true, browser };
        } catch (error) {
            console.error(`Test #${testNumber} Error during form submission:`, error);
            
            const url = await page.url();
            console.log(`Test #${testNumber} Error URL:`, url);
            
            const content = await page.content();
            console.log(`Test #${testNumber} Error page content:`, content.substring(0, 500));
            
            throw new Error(`Form submission failed: ${error.message}`);
        }

        await browser.close();
        return true;
    } catch (error) {
        console.error(`Test #${testNumber} failed:`, error);
        if (page) {
            await page.screenshot({ path: `error-screenshot-${testNumber}.png` }).catch(() => {});
            
            // Log form state
            await page.evaluate(() => {
                const form = document.querySelector('form[name="listForm"]');
                if (form) {
                    console.log('Form action:', form.action);
                    console.log('Form method:', form.method);
                    console.log('Form enctype:', form.enctype);
                    
                    const submitBtn = form.querySelector('input[type="submit"], button[type="submit"]');
                    if (submitBtn) {
                        console.log('Submit button found:', submitBtn.outerHTML);
                    } else {
                        console.log('Submit button not found');
                    }
                } else {
                    console.log('Form not found');
                }
            });
        }
        if (browser) {
            await browser.close().catch(() => {});
        }
        return false;
    }
}

// Run a single test
(async () => {
    try {
        const success = await runTest(1);
        
        // Print summary
        console.log('\nTest Summary:');
        console.log('-------------');
        console.log(`Test #1: ${success ? 'PASSED' : 'FAILED'}`);
        
        process.exit(success ? 0 : 1);
    } catch (error) {
        console.error('Test execution failed:', error);
        process.exit(1);
    }
})(); 