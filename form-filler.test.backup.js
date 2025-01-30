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
    await page.evaluate(() => {
        // Clear any existing form data
        document.querySelectorAll('input:not([type="hidden"]):not([type="submit"])').forEach(input => {
            input.value = '';
        });
    });

    const randomData = {
        name: generateRandomCompanyName(),
        name_ar: generateRandomArabicName(),
        pobox: generateRandomNumber(10000, 99999).toString(),
        zipcode: generateRandomNumber(100, 999).toString(),
        address: generateRandomAddress(),
        address_ar: generateRandomAddress(),
        country: 'Oman',
        city: 'Muscat',
        mobile_number: generateRandomPhone(),
        phone_number: generateRandomPhone(),
        fax_number: generateRandomPhone(),
        cr_number: generateRandomCRNumber(),
        cr_legal_type: 'Limited Liability Company - LLC',
        user_email: generateRandomEmail(),
        business_type: 'Food',
        number_of_employee: generateRandomNumber(50, 500).toString(),
        riyada_certificate: 'Yes' // Set to Yes to test conditional fields
    };

    // Fill in the form with random data
    await page.evaluate(async (randomData) => {
        const form = document.querySelector('form[name="listForm"]');
        if (!form) {
            console.error('Form not found');
            return;
        }

        // Set today's date in MySQL format (YYYY-MM-DD)
        const today = new Date();
        const mysqlDate = today.toISOString().split('T')[0];
        
        // Create or update record_date input
        let recordDateInput = form.querySelector('input[name="record_date"]');
        if (!recordDateInput) {
            recordDateInput = document.createElement('input');
            recordDateInput.type = 'hidden';
            recordDateInput.name = 'record_date';
            form.appendChild(recordDateInput);
        }
        recordDateInput.value = mysqlDate;
        
        // Set CR dates
        const futureDate = new Date(today);
        futureDate.setFullYear(today.getFullYear() + 1);
        const mysqlFutureDate = futureDate.toISOString().split('T')[0];

        // Set CR registration date
        const regDateInput = form.querySelector('input[name="cr_registration_date"]');
        if (regDateInput) {
            regDateInput.value = mysqlDate;
            regDateInput.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // Set CR expiry date
        const expDateInput = form.querySelector('input[name="cr_expiry_date"]');
        if (expDateInput) {
            expDateInput.value = mysqlFutureDate;
            expDateInput.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // Handle Riyada certificate fields first
        const riyadaSelect = form.querySelector('select[name="riyada_certificate"]');
        if (riyadaSelect) {
            riyadaSelect.value = randomData.riyada_certificate;
            // Use proper event triggering to ensure jQuery handlers are called
            riyadaSelect.dispatchEvent(new Event('change', { bubbles: true }));
            
            // If Yes, set expiry date and handle documents
            if (randomData.riyada_certificate === 'Yes') {
                // Wait briefly for animation
                await new Promise(resolve => setTimeout(resolve, 100));
                
                // Set expiry date
                const expInput = form.querySelector('input[name="exp_date"]');
                if (expInput) {
                    expInput.value = mysqlFutureDate;
                    expInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
                
                // Handle documents field if visible
                const documentsInput = form.querySelector('input[name="documents_req"]');
                if (documentsInput) {
                    const file = new File(['test'], 'riyada_cert.pdf', { type: 'application/pdf' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    documentsInput.files = dataTransfer.files;
                    documentsInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
        }

        // Set other form fields
        for (const [key, value] of Object.entries(randomData)) {
            if (key !== 'riyada_certificate') { // Skip as we handled it specially
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    input.value = value;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }
        }

        // Log form data for debugging
        const formData = new FormData(form);
        console.log('Form data entries:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Handle checkboxes and radio buttons
        document.querySelector('input[name="tnc"]').checked = true;
        const healthcareNo = document.querySelector('input[name="healthcare_status"][value="NO"]');
        if (healthcareNo) healthcareNo.checked = true;

        // Handle file inputs
        const fileInputs = ['upload_document1', 'upload_document2', 'upload_document3'];
        fileInputs.forEach(inputName => {
            const input = document.querySelector(`input[name="${inputName}"]`);
            if (input) {
                const file = new File(['test'], 'test.pdf', { type: 'application/pdf' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        // Fill contact persons
        const contactCount = 2;
        for (let i = 0; i < contactCount; i++) {
            const fields = {
                'title[]': 'Mr.',
                'first_name[]': `Contact ${i + 1}`,
                'last_name[]': 'Test',
                'job_title[]': 'Manager',
                'email_id[]': `contact${i + 1}_${Math.random().toString(36).substring(7)}@example.com`,
                'phone_number1[]': `1234567${i + 1}`
            };

            Object.keys(fields).forEach(key => {
                const elements = document.querySelectorAll(`[name="${key}"]`);
                if (elements[i]) {
                    elements[i].value = fields[key];
                    elements[i].dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        }
    }, randomData);

    return randomData;
}

// Main test function
async function runTest(testNumber) {
    let browser;
    let page;
    
    try {
        console.log(`\nStarting Test #${testNumber}`);
        
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });

        page = await browser.newPage();
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

        // Select package components
await page.evaluate(() => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
                if (checkbox.name && (
                    checkbox.name.includes('gtins_annual_fee') || 
                    checkbox.name.includes('gln_price') || 
                    checkbox.name.includes('sscc_price')
        )) {
            checkbox.checked = true;
            checkbox.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
            
            if (typeof add === 'function') {
                add();
            }
});

        // Wait for calculations
        await new Promise(resolve => setTimeout(resolve, 2000));

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

            // Store form data for database verification
            formData = await page.evaluate(() => {
                const form = document.querySelector('form[name="listForm"]');
                const data = {
                    name: document.querySelector('input[name="name"]')?.value,
                    name_ar: document.querySelector('input[name="name_ar"]')?.value,
                    pobox: document.querySelector('input[name="pobox"]')?.value,
                    zipcode: document.querySelector('input[name="zipcode"]')?.value,
                    address: document.querySelector('input[name="address"]')?.value,
                    address_ar: document.querySelector('input[name="address_ar"]')?.value,
                    country: document.querySelector('select[name="country"]')?.value,
                    city: document.querySelector('select[name="city"]')?.value,
                    mobile_number: document.querySelector('input[name="mobile_number"]')?.value,
                    phone_number: document.querySelector('input[name="phone_number"]')?.value,
                    fax_number: document.querySelector('input[name="fax_number"]')?.value,
                    cr_number: document.querySelector('input[name="cr_number"]')?.value,
                    cr_legal_type: document.querySelector('select[name="cr_legal_type"]')?.value,
                    user_email: document.querySelector('input[name="user_email"]')?.value,
                    business_type: document.querySelector('select[name="business_type_product_category"]')?.value,
                    number_of_employee: document.querySelector('input[name="number_of_employee"]')?.value,
                    // Riyada certificate fields
                    riyada_certificate: document.querySelector('select[name="riyada_certificate"]')?.value
                };

                // Only include exp_date and documents if Riyada certificate is Yes
                if (data.riyada_certificate === 'Yes') {
                    data.exp_date = document.querySelector('input[name="exp_date"]')?.value;
                    const documentsInput = document.querySelector('input[name="documents_req"]');
                    if (documentsInput?.files?.[0]) {
                        data.documents_req = documentsInput.files[0].name;
                    }
                }

                return data;
            });

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