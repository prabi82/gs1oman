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
    return `968${generateRandomNumber(1000, 9999)}${generateRandomNumber(1000, 9999)}`;
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
    // First inject helper functions into page context
    await page.evaluate((helpers) => {
        window.generateRandomString = helpers.generateRandomString;
        window.generateRandomNumber = helpers.generateRandomNumber;
        window.generateRandomEmail = helpers.generateRandomEmail;
        window.generateRandomPhone = helpers.generateRandomPhone;
        window.generateRandomCRNumber = helpers.generateRandomCRNumber;
        window.generateRandomArabicName = helpers.generateRandomArabicName;
        window.generateRandomCompanyName = helpers.generateRandomCompanyName;
        window.generateRandomAddress = helpers.generateRandomAddress;
    }, {
        generateRandomString,
        generateRandomNumber,
        generateRandomEmail,
        generateRandomPhone,
        generateRandomCRNumber,
        generateRandomArabicName,
        generateRandomCompanyName,
        generateRandomAddress
    });

    // Generate random data
    const randomData = await page.evaluate(() => {
        return {
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
            business_type_product_category: 'Food',
            number_of_employee: '50',
            healthcare_status: 'No',
            main_contact_status: '1',
            product_id: '3',
            product_name: 'Basic Package',
            registration_fee: '100',
            gtins_annual_fee: '50',
            gln_price: '25',
            sscc_price: '25',
            tnc: '1'
        };
    });

    // Fill the form with random data
    await page.evaluate((data) => {
        // Fill all input fields
        Object.entries(data).forEach(([key, value]) => {
            const input = document.querySelector(`input[name="${key}"], select[name="${key}"]`);
            if (input) {
                input.value = value;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        // Set dates
        const today = new Date();
        const mysqlDate = today.toISOString().split('T')[0];
        const futureDate = new Date(today);
        futureDate.setFullYear(today.getFullYear() + 1);
        const mysqlFutureDate = futureDate.toISOString().split('T')[0];

        // Set CR dates
        const dateInputs = {
            'cr_registration_date': mysqlDate,
            'cr_expiry_date': mysqlFutureDate,
            'record_date': mysqlDate
        };

        Object.entries(dateInputs).forEach(([key, value]) => {
            const input = document.querySelector(`input[name="${key}"]`);
            if (input) {
                input.value = value;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        // Handle file uploads
        const fileInputs = ['upload_document1', 'upload_document2', 'upload_document3'];
        fileInputs.forEach(name => {
            const input = document.querySelector(`input[name="${name}"]`);
            if (input) {
                const file = new File(['test'], 'test.pdf', { type: 'application/pdf' });
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        // Fill contact persons
        const contactData = {
            'title[]': ['Mr.', 'Mr.'],
            'first_name[]': ['Contact 1', 'Contact 2'],
            'last_name[]': ['Person', 'Person'],
            'job_title[]': ['Manager', 'Supervisor'],
            'email_id[]': [generateRandomEmail(), generateRandomEmail()],
            'phone_number1[]': [generateRandomPhone(), generateRandomPhone()]
        };

        Object.entries(contactData).forEach(([key, values]) => {
            const inputs = document.querySelectorAll(`[name="${key}"]`);
            inputs.forEach((input, index) => {
                input.value = values[index];
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });

        // Check required checkboxes
        const tnc = document.querySelector('input[name="tnc"]');
        if (tnc) tnc.checked = true;

        // Log form data for verification
        const form = document.querySelector('form[name="listForm"]');
        const formData = new FormData(form);
        console.log('Form data before submission:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
    }, randomData);

    // Submit the form
    const response = await page.evaluate(() => {
        return new Promise((resolve) => {
            const form = document.querySelector('form[name="listForm"]');
            
            // Add submit button if not present
            let submitBtn = form.querySelector('input[name="submit"]');
            if (!submitBtn) {
                submitBtn = document.createElement('input');
                submitBtn.type = 'submit';
                submitBtn.name = 'submit';
                submitBtn.value = 'Submit';
                submitBtn.className = 'btn btn-primary';
                form.appendChild(submitBtn);
            }

            // Submit form
            submitBtn.click();

            // Check response after delay
            setTimeout(() => {
                const result = {
                    url: window.location.href,
                    success: document.querySelector('#successMessage')?.textContent,
                    error: document.querySelector('#errorMessage')?.textContent,
                    redirected: window.location.href.includes('thanks.php')
                };
                console.log('Submission result:', result);
                resolve(result);
            }, 3000);
        });
    });

    console.log('Form submission response:', response);
    
    // Wait for any redirects
    await new Promise(resolve => setTimeout(resolve, 2000));
    
    return response;
}

// Main test function
async function runTest(testNumber) {
    let browser;
    let page;
    
    try {
        console.log(`\nStarting Form Fill Test #${testNumber}`);
        
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });

        page = await browser.newPage();
        page.on('console', msg => console.log(`Test #${testNumber} Browser console:`, msg.text()));

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

        console.log(`Test #${testNumber}: Form filled successfully. Ready for manual inspection.`);
        console.log('Please review the form data and submit manually if needed.');

        // Keep the browser open for manual inspection
        // await browser.close(); // Commented out to keep browser open

        return true;
    } catch (error) {
        console.error(`Test #${testNumber} failed:`, error);
        if (page) {
            await page.screenshot({ path: `error-screenshot-${testNumber}.png` }).catch(() => {});
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
        console.log(`Form Fill Test #1: ${success ? 'PASSED' : 'FAILED'}`);
        
        // Don't exit process to keep browser open
        // process.exit(success ? 0 : 1);
    } catch (error) {
        console.error('Test execution failed:', error);
        // process.exit(1);
    }
})(); 
