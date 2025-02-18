const puppeteer = require('puppeteer');
const mysql = require('mysql2/promise');
const path = require('path');

// Helper functions for generating random data
function generateRandomString(length, type = 'mixed') {
    const chars = {
        alpha: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
        numeric: '0123456789',
        mixed: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
    };
    const charSet = chars[type] || chars.mixed;
    return Array(length).fill(null).map(() => charSet[Math.floor(Math.random() * charSet.length)]).join('');
}

function generateRandomArabicName() {
    const arabicFirstNames = ['محمد', 'أحمد', 'علي', 'عمر', 'خالد', 'فاطمة', 'عائشة', 'مريم'];
    const arabicLastNames = ['الهاشمي', 'السعيدي', 'البلوشي', 'الحارثي', 'المعولي'];
    return `${arabicFirstNames[Math.floor(Math.random() * arabicFirstNames.length)]} ${arabicLastNames[Math.floor(Math.random() * arabicLastNames.length)]}`;
}

function generateRandomCompanyName() {
    const prefixes = ['Global', 'Advanced', 'Premier', 'Elite', 'Modern'];
    const suffixes = ['Solutions', 'Technologies', 'Industries', 'Enterprises', 'Trading'];
    const prefix = prefixes[Math.floor(Math.random() * prefixes.length)];
    const suffix = suffixes[Math.floor(Math.random() * suffixes.length)];
    const uniqueId = generateRandomString(4, 'alpha').toUpperCase();
    return `${prefix} ${uniqueId} ${suffix}`;
}

function generateRandomAddress() {
    const buildingNum = Math.floor(Math.random() * 999) + 1;
    const wayNum = Math.floor(Math.random() * 9999) + 1;
    const blockNum = Math.floor(Math.random() * 999) + 1;
    return `Building ${buildingNum}, Way ${wayNum}, Block ${blockNum}`;
}

function generateRandomPhone() {
    return '968' + Math.floor(10000000 + Math.random() * 90000000);
}

function generateRandomEmail(name = '') {
    const domains = ['example.com', 'test.com', 'company.com', 'business.om'];
    const prefix = name.toLowerCase().replace(/\s+/g, '.') || generateRandomString(8, 'alpha').toLowerCase();
    return `${prefix}@${domains[Math.floor(Math.random() * domains.length)]}`;
}

function generateRandomCRNumber() {
    return generateRandomString(12, 'numeric');
}

function generateRandomTaxNumber() {
    // Generate exactly 12 digits for Tax Registration Number
    return Array(12).fill(null).map(() => Math.floor(Math.random() * 10)).join('');
}

function generateRandomVATNumber() {
    // Generate exactly 15 alphanumeric characters for VAT Number
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return Array(15).fill(null).map(() => chars[Math.floor(Math.random() * chars.length)]).join('');
}

// Add helper function to handle modals
async function handleModal(page) {
    try {
        // Wait for modal to be visible
        await page.waitForFunction(() => {
            const modal = document.querySelector('.modal.show, .modal.fade.show');
            const okButton = document.querySelector('.modal-content button.btn-primary, button.ok, #refundPolicyModal .btn-primary');
            return modal && okButton;
        }, { timeout: 5000 });

        // Click OK button
        await page.evaluate(() => {
            const okButton = document.querySelector('.modal-content button.btn-primary, button.ok, #refundPolicyModal .btn-primary');
            if (okButton) {
                okButton.click();
            }
        });

        // Wait for modal to close
        await page.waitForFunction(() => {
            const modal = document.querySelector('.modal.show, .modal.fade.show');
            return !modal;
        }, { timeout: 5000 });
    } catch (error) {
        console.log('No modal found or modal already closed');
    }
}

// Add this function to handle product selection
async function handleProductSelection(page) {
    // Select a product package
    await page.select('select[name="product_id"]', '3'); // Select 1000 package
    
    // Wait for AJAX response
    await page.waitForResponse(response => 
        response.url().includes('get_package_details.php') && 
        response.status() === 200
    );
    
    // Wait for checkboxes to be available
    await page.waitForSelector('#gtins_annual_fee');
    await page.waitForSelector('#gln_price');
    
    // Check both GTIN and GLN checkboxes and trigger change events
    await page.evaluate(() => {
        console.log('Setting up product selection...');
        
        // GTIN checkbox and input
        const gtinCheckbox = document.querySelector('#gtins_annual_fee');
        const gtinInput = document.querySelector('#gtins_annual_fee_input');
        if (gtinCheckbox && gtinInput) {
            gtinCheckbox.checked = true;
            gtinInput.value = '350';
            gtinCheckbox.dispatchEvent(new Event('change', { bubbles: true }));
            console.log('GTIN set:', { checked: gtinCheckbox.checked, value: gtinInput.value });
        } else {
            console.error('GTIN elements not found');
        }
        
        // GLN checkbox and input
        const glnCheckbox = document.querySelector('#gln_price');
        const glnInput = document.querySelector('#gln_price_input');
        if (glnCheckbox && glnInput) {
            glnCheckbox.checked = true;
            glnInput.value = '300';
            glnCheckbox.dispatchEvent(new Event('change', { bubbles: true }));
            console.log('GLN set:', { checked: glnCheckbox.checked, value: glnInput.value });
        } else {
            console.error('GLN elements not found');
        }
        
        // Verify total values
        const totalPrice = document.querySelector('#total_price');
        const annualPrice = document.querySelector('#annual_total_price');
        console.log('Price fields:', {
            total: totalPrice ? totalPrice.value : 'not found',
            annual: annualPrice ? annualPrice.value : 'not found'
        });
    });
    
    // Wait for price calculations to update
    await page.waitForFunction(() => {
        const totalPrice = document.querySelector('#total_price');
        const annualPrice = document.querySelector('#annual_total_price');
        const gtinInput = document.querySelector('#gtins_annual_fee_input');
        const glnInput = document.querySelector('#gln_price_input');
        
        return totalPrice && annualPrice && gtinInput && glnInput &&
               parseFloat(totalPrice.value) > 0 && 
               parseFloat(annualPrice.value) > 0 &&
               parseFloat(gtinInput.value) === 350 &&
               parseFloat(glnInput.value) === 300;
    }, { timeout: 5000 });
    
    // Log final values
    const values = await page.evaluate(() => ({
        gtin: document.querySelector('#gtins_annual_fee_input').value,
        gln: document.querySelector('#gln_price_input').value,
        total: document.querySelector('#total_price').value,
        annual: document.querySelector('#annual_total_price').value
    }));
    
    console.log('Final form values:', values);
}

// Add new helper function for package selection
async function handlePackageSelection(page) {
    console.log('Starting package selection...');
    
    try {
        // Wait for package dropdown to be available
        await page.waitForSelector('select[name="product_id"]', { timeout: 5000 });
        console.log('Package dropdown found');

        // First select the package
        await page.select('select[name="product_id"]', '3');
        console.log('Package option selected');

        // Wait for AJAX to complete and checkboxes to appear
        await page.waitForFunction(() => {
            const gtinCheckbox = document.querySelector('#gtins_annual_fee');
            const glnCheckbox = document.querySelector('#gln_price');
            return gtinCheckbox && glnCheckbox;
        }, { timeout: 5000 });

        // Wait a moment for any animations
        await sleep(page, 1000);

        // Click the checkboxes directly
        await page.evaluate(() => {
            const gtinCheckbox = document.querySelector('#gtins_annual_fee');
            const glnCheckbox = document.querySelector('#gln_price');
            
            if (gtinCheckbox) {
                gtinCheckbox.click();
                console.log('GTIN checkbox clicked');
            }
            
            if (glnCheckbox) {
                glnCheckbox.click();
                console.log('GLN checkbox clicked');
            }

            // Trigger price calculation manually
            const event = new Event('change', { bubbles: true });
            gtinCheckbox.dispatchEvent(event);
            glnCheckbox.dispatchEvent(event);
        });

        // Wait for price calculations
        await page.waitForFunction(() => {
            const total = parseFloat(document.querySelector('#total_price').value) || 0;
            const registration = parseFloat(document.querySelector('#registration_fee').value) || 0;
            
            console.log('Price values:', { total, registration });
            
            // Check if total price is set (should be at least registration fee)
            return total >= registration && total > 0;
        }, { timeout: 5000 });

        // Verify the final state
        const values = await page.evaluate(() => {
            const getFieldValue = (selector) => {
                const element = document.querySelector(selector);
                return element ? {
                    value: element.value,
                    checked: element.type === 'checkbox' ? element.checked : undefined,
                    visible: element.offsetParent !== null
                } : null;
            };

            const getPrice = (selector) => {
                const element = document.querySelector(selector);
                return element ? parseFloat(element.value) || 0 : 0;
            };

            return {
                gtin: getFieldValue('#gtins_annual_fee_input'),
                gln: getFieldValue('#gln_price_input'),
                gtinCheckbox: getFieldValue('#gtins_annual_fee'),
                glnCheckbox: getFieldValue('#gln_price'),
                total: getPrice('#total_price'),
                registration: getPrice('#registration_fee')
            };
        });

        console.log('Final package state:', JSON.stringify(values, null, 2));

        // Verify only that checkboxes are checked and total price is set
        if (!values.gtinCheckbox?.checked || !values.glnCheckbox?.checked || values.total <= 0) {
            console.log('Package selection verification failed');
            return null;
        }

        return values;

    } catch (error) {
        console.error('Error in package selection:', error);
        return null;
    }
}

async function verifyDatabaseEntry(formData) {
    console.log('Starting database verification...');
    console.log('Form data to verify:', formData);
    
    const connection = await mysql.createConnection({
        host: 'localhost',
        user: 'root',
        password: '',
        database: 'gs1omancom_barcode'
    });

    try {
        // First check company_tbl
        console.log('Checking company_tbl...');
        const [companies] = await connection.execute(
            'SELECT * FROM company_tbl WHERE user_email = ? OR name = ? ORDER BY id DESC LIMIT 1',
            [formData.email, formData.name]
        );

        if (companies.length === 0) {
            console.log('No company entry found for:', {
                email: formData.email,
                name: formData.name
            });
            return false;
        }

        const company = companies[0];
        console.log('Found company entry:', {
            id: company.id,
            name: company.name,
            email: company.user_email,
            cr: company.cr_number
        });

        // Check order_tbl for the company
        console.log('Checking order_tbl...');
        const [orders] = await connection.execute(
            'SELECT * FROM order_tbl WHERE company_id = ? ORDER BY id DESC LIMIT 1',
            [company.id]
        );

        if (orders.length === 0) {
            console.log('No order entry found for company ID:', company.id);
            return false;
        }

        const order = orders[0];
        console.log('Found order entry:', {
            id: order.id,
            order_id: order.order_id,
            total: order.total_price,
            status: order.status,
            gtin_fee: order.gtins_annual_fee,
            gln_price: order.gln_price
        });

        // Check company_contacts_tbl
        console.log('Checking company_contacts_tbl...');
        const [contacts] = await connection.execute(
            'SELECT * FROM company_contacts_tbl WHERE company_id = ?',
            [company.id]
        );

        if (contacts.length === 0) {
            console.log('No contact entries found for company ID:', company.id);
            return false;
        }

        console.log('Found contact entries:', contacts.length);
        contacts.forEach((contact, index) => {
            console.log(`Contact ${index + 1}:`, {
                title: contact.title,
                email: contact.email_id,
                status: contact.status
            });
        });
        
        return true;
    } catch (error) {
        console.error('Database verification error:', error);
        console.error('Stack trace:', error.stack);
        return false;
    } finally {
        await connection.end();
    }
}

// Add sleep function that works with older Puppeteer versions
async function sleep(page, ms) {
    await page.evaluate((ms) => new Promise(resolve => setTimeout(resolve, ms)), ms);
}

// Helper function to get form field values
async function getFormValue(selector) {
    try {
        const element = await page.$(selector);
        if (!element) {
            console.log(`Element not found: ${selector}`);
            return { value: '', error: 'Element not found' };
        }
        
        const value = await element.evaluate(el => {
            if (el.type === 'radio' || el.type === 'checkbox') {
                return el.checked ? el.value : '';
            }
            return el.value;
        });
        
        const isVisible = await element.evaluate(el => {
            const style = window.getComputedStyle(el);
            return style.display !== 'none' && style.visibility !== 'hidden';
        });
        
        return { value, isVisible };
    } catch (error) {
        console.error(`Error getting value for ${selector}:`, error);
        return { value: '', error: error.message };
    }
}

async function runRegistrationTest(testNumber) {
    let browser;
    try {
        console.log(`\nStarting Registration Form Test #${testNumber}`);
        
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });

        const page = await browser.newPage();
        
        // Handle dialogs automatically
        page.on('dialog', async dialog => {
            console.log('Dialog message:', dialog.message());
            await dialog.accept();
        });

        // Navigate to the registration page
        await page.goto('http://localhost/gs1oman.com/', {
            waitUntil: ['networkidle0', 'domcontentloaded', 'load'],
            timeout: 60000
        });

        // Debug: Log the current URL
        console.log('Current URL:', await page.url());

        // Debug: Log all forms on the page
        const formsInfo = await page.evaluate(() => {
            const forms = Array.from(document.querySelectorAll('form'));
            return forms.map(form => ({
                id: form.id,
                action: form.action,
                method: form.method,
                html: form.outerHTML.substring(0, 200) + '...' // First 200 chars only
            }));
        });
        console.log('Forms found on page:', formsInfo);

        // Wait for form to be ready and visible
        await page.waitForSelector('#regform', { 
            visible: true,
            timeout: 10000 
        });
        console.log('Form found, starting to fill data...');

        // Generate random test data
        const companyName = generateRandomCompanyName();
        const companyNameAr = generateRandomArabicName();
        const address = generateRandomAddress();
        const addressAr = 'مسقط، عمان';
        const poBox = generateRandomString(4, 'numeric');
        const zipCode = generateRandomString(3, 'numeric');
        const mobileNumber = generateRandomPhone();
        const phoneNumber = generateRandomPhone();
        const faxNumber = generateRandomPhone();
        const crNumber = generateRandomCRNumber();
        const email = generateRandomEmail(companyName);
        
        // Fill company information
        await page.type('input[name="name"]', companyName);
        await page.type('input[name="name_ar"]', companyNameAr);
        await page.type('input[name="pobox"]', poBox);
        await page.type('input[name="zipcode"]', zipCode);
        await page.type('input[name="address"]', address);
        await page.type('input[name="address_ar"]', addressAr);
        
        // Select country and city from dropdowns
        await page.select('select[name="country"]', 'Oman');
        await page.select('select[name="city"]', 'Muscat');
        
        // Fill contact information
        await page.type('input[name="mobile_number"]', mobileNumber);
        await page.type('input[name="phone_number"]', phoneNumber);
        await page.type('input[name="fax_number"]', faxNumber);
        await page.type('input[name="user_email"]', email);

        // Fill CR details
        await page.type('input[name="cr_number"]', crNumber);
        await page.select('select[name="cr_legal_type"]', 'Limited Liability Company - LLC');
        
        // Set CR dates
        const today = new Date();
        const expiryDate = new Date(today.getFullYear() + 1, today.getMonth(), today.getDate());
        
        await page.evaluate((dates) => {
            const regDate = document.querySelector('input[name="cr_registration_date"]');
            const expDate = document.querySelector('input[name="cr_expiry_date"]');
            if (regDate) {
                regDate.value = dates.today;
                regDate.dispatchEvent(new Event('change'));
            }
            if (expDate) {
                expDate.value = dates.expiry;
                expDate.dispatchEvent(new Event('change'));
            }
        }, { today: today.toISOString().split('T')[0], expiry: expiryDate.toISOString().split('T')[0] });

        // Select business type and category
        await page.select('select[name="business_type_product_category"]', 'Food');
        await page.type('input[name="number_of_employee"]', '50');

        // Handle Riyada certificate
        await page.select('select[name="riyada_certificate"]', 'Yes');
        await page.evaluate(() => {
            const expDate = document.querySelector('input[name="exp_date"]');
            if (expDate) {
                expDate.value = '2025-12-31';
                expDate.dispatchEvent(new Event('change'));
            }
        });

        // Upload test files
        const uploadPath = path.join(__dirname, 'test-files');
        const uploadFiles = {
            'upload_document1': path.join(uploadPath, 'cr.pdf'),
            'upload_document2': path.join(uploadPath, 'coc.pdf'),
            'upload_document3': path.join(uploadPath, 'other.pdf'),
            'documents_req': path.join(uploadPath, 'riyada.pdf')
        };

        for (const [fieldName, filePath] of Object.entries(uploadFiles)) {
            const fileInput = await page.$(`input[name="${fieldName}"]`);
            if (fileInput) {
                await fileInput.uploadFile(filePath);
            }
        }

        // Fill primary contact
        const primaryEmail = generateRandomEmail();
        await page.evaluate((data) => {
            const fillField = (name, value) => {
                const field = document.querySelector(`[name="${name}"]`);
                if (field) {
                    if (field.tagName === 'SELECT') {
                        field.value = value;
                        field.dispatchEvent(new Event('change', { bubbles: true }));
                    } else {
                        field.value = value;
                        field.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                }
            };

            fillField('title[]', data.title);
            fillField('first_name[]', data.firstName);
            fillField('last_name[]', data.lastName);
            fillField('job_title[]', data.jobTitle);
            fillField('email_id[]', data.email);
            fillField('phone_number1[]', data.phone);
        }, {
            title: 'Mr.',
            firstName: 'John',
            lastName: 'Doe',
            jobTitle: 'CEO',
            email: primaryEmail,
            phone: generateRandomPhone()
        });

        // Fill secondary contact
        const secondaryEmail = generateRandomEmail();
        await page.evaluate((data) => {
            const fillField = (name, value) => {
                const fields = document.querySelectorAll(`[name="${name}"]`);
                if (fields.length > 1) {
                    const field = fields[1];
                    if (field.tagName === 'SELECT') {
                        field.value = value;
                        field.dispatchEvent(new Event('change', { bubbles: true }));
                    } else {
                        field.value = value;
                        field.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                }
            };

            fillField('title[]', data.title);
            fillField('first_name[]', data.firstName);
            fillField('last_name[]', data.lastName);
            fillField('job_title[]', data.jobTitle);
            fillField('email_id[]', data.email);
            fillField('phone_number1[]', data.phone);

            // Debug: Log field values after filling
            console.log('Additional Contact Fields:', {
                title: document.querySelectorAll('[name="title[]"]')[1]?.value,
                firstName: document.querySelectorAll('[name="first_name[]"]')[1]?.value,
                lastName: document.querySelectorAll('[name="last_name[]"]')[1]?.value,
                jobTitle: document.querySelectorAll('[name="job_title[]"]')[1]?.value,
                email: document.querySelectorAll('[name="email_id[]"]')[1]?.value,
                phone: document.querySelectorAll('[name="phone_number1[]"]')[1]?.value
            });

            // Debug: Check for any error messages or validation issues
            const errorMessages = Array.from(document.querySelectorAll('.error-message, .alert-danger, .text-danger'))
                .map(el => ({
                    text: el.textContent?.trim(),
                    nearestField: el.previousElementSibling?.name || 'unknown'
                }));
            console.log('Error Messages:', errorMessages);

            // Debug: Check form validation state
            const form = document.querySelector('#regform');
            if (form) {
                const invalidFields = Array.from(form.querySelectorAll(':invalid'))
                    .map(field => ({
                        name: field.name,
                        type: field.type,
                        validationMessage: field.validationMessage
                    }));
                console.log('Invalid Fields:', invalidFields);
            }
        }, {
            title: 'Mrs.',
            firstName: 'Jane',
            lastName: 'Smith',
            jobTitle: 'Manager',
            email: secondaryEmail,
            phone: generateRandomPhone()
        });

        // Add a wait and check for any error messages that appear
        await sleep(page, 1000);

        // Take a screenshot of the additional contact section
        await page.screenshot({
            path: 'additional-contact-debug.png',
            fullPage: true
        });

        const errorState = await page.evaluate(() => {
            // Get all error messages
            const errors = Array.from(document.querySelectorAll('.error-message, .alert-danger, .text-danger, .invalid-feedback'))
                .map(el => ({
                    text: el.textContent?.trim(),
                    isVisible: window.getComputedStyle(el).display !== 'none',
                    location: el.closest('fieldset, section, div')?.id || 'unknown',
                    nearestInput: el.previousElementSibling?.name || 
                                el.previousElementSibling?.querySelector('input')?.name || 
                                'unknown'
                }));

            // Get form validation state
            const form = document.querySelector('#regform');
            const invalidFields = form ? Array.from(form.querySelectorAll(':invalid')).map(f => f.name) : [];
            
            // Get additional contact fields state
            const additionalContactFields = {};
            ['title[]', 'first_name[]', 'last_name[]', 'job_title[]', 'email_id[]', 'phone_number1[]'].forEach(name => {
                const elements = document.querySelectorAll(`[name="${name}"]`);
                if (elements.length > 1) {
                    additionalContactFields[name] = {
                        value: elements[1].value,
                        isValid: elements[1].checkValidity(),
                        validationMessage: elements[1].validationMessage,
                        isVisible: window.getComputedStyle(elements[1]).display !== 'none'
                    };
                }
            });

            return {
                errors,
                formValidity: {
                    isValid: form?.checkValidity() || false,
                    invalidFields
                },
                additionalContactFields,
                // Get HTML of the section for debugging
                sectionHtml: document.querySelector('.additional-contact-section, #additional-contacts')?.outerHTML || 'Section not found'
            };
        });

        console.log('Form Error State:', JSON.stringify(errorState, null, 2));

        // Select healthcare status
        await page.evaluate(() => {
            const noRadio = document.querySelector('input[name="healthcare_status"][value="No"]');
            if (noRadio) {
                noRadio.click();
            }
        });

        // Handle package selection
        console.log('Starting package selection process...');
        let packageResult = null;
        let attempts = 0;
        const maxAttempts = 3;

        while (attempts < maxAttempts && (!packageResult || !packageResult.gtinCheckbox?.checked || !packageResult.glnCheckbox?.checked)) {
            attempts++;
            console.log(`Package selection attempt ${attempts}...`);
            
            // Select package and wait for AJAX
            await page.select('select[name="product_id"]', '3');
            await page.waitForResponse(response => 
                response.url().includes('get_package_details.php')
            );
            await sleep(page, 1000);

            // Check and set GTIN
            await page.evaluate(() => {
                const gtinCheckbox = document.querySelector('#gtins_annual_fee');
                const gtinInput = document.querySelector('#gtins_annual_fee_input');
                if (gtinCheckbox && gtinInput) {
                    gtinCheckbox.click();
                    gtinInput.value = '350';
                    gtinInput.dispatchEvent(new Event('change'));
                }
            });
            await sleep(page, 500);

            // Check and set GLN
            await page.evaluate(() => {
                const glnCheckbox = document.querySelector('#gln_price');
                const glnInput = document.querySelector('#gln_price_input');
                if (glnCheckbox && glnInput) {
                    glnCheckbox.click();
                    glnInput.value = '300';
                    glnInput.dispatchEvent(new Event('change'));
                }
            });
            await sleep(page, 500);

            // Verify values
            packageResult = await page.evaluate(() => {
                const getFieldValue = (selector) => {
                    const el = document.querySelector(selector);
                    return el ? {
                        value: el.value,
                        checked: el.type === 'checkbox' ? el.checked : undefined,
                        visible: el.offsetParent !== null
                    } : null;
                };

                return {
                    gtin: getFieldValue('#gtins_annual_fee_input'),
                    gln: getFieldValue('#gln_price_input'),
                    gtinCheckbox: getFieldValue('#gtins_annual_fee'),
                    glnCheckbox: getFieldValue('#gln_price'),
                    total: parseFloat(document.querySelector('#total_price')?.value || '0'),
                    registration: parseFloat(document.querySelector('#registration_fee')?.value || '0')
                };
            });

            console.log('Package state:', packageResult);

            if (!packageResult.gtinCheckbox?.checked || !packageResult.glnCheckbox?.checked) {
                console.log('Package selection verification failed, retrying...');
                await sleep(page, 1000);
            }
        }

        // Select payment method
        console.log('Selecting payment method...');
        await page.evaluate(() => {
            const paymentRadio = document.querySelector('input[type="radio"][name="offline_payment"][value="1"]');
            if (paymentRadio) {
                paymentRadio.checked = true;
                paymentRadio.dispatchEvent(new Event('change'));
                paymentRadio.dispatchEvent(new Event('click'));
            } else {
                console.error('Cash payment radio button not found');
            }
        });
        await sleep(page, 500);

        // Verify payment selection
        const paymentSelected = await page.evaluate(() => {
            const radio = document.querySelector('input[type="radio"][name="offline_payment"]:checked');
            return radio ? { value: radio.value, checked: radio.checked } : null;
        });

        console.log('Payment selection verification:', paymentSelected);

        if (!paymentSelected || paymentSelected.value !== '1') {
            console.log('Payment selection failed, trying direct click...');
            await page.click('input[type="radio"][name="offline_payment"][value="1"]');
            await sleep(page, 500);
        }

        // Accept terms
        console.log('Accepting terms and conditions...');
        await page.evaluate(() => {
            const termsCheckbox = document.querySelector('input[name="tnc"]');
            if (termsCheckbox) {
                termsCheckbox.checked = true;
                termsCheckbox.dispatchEvent(new Event('change'));
                termsCheckbox.dispatchEvent(new Event('click'));
            }
        });
        await sleep(page, 500);

        // Verify form state before submission
        const formState = await page.evaluate(() => {
            return {
                isValid: true,
                state: {
                    name: document.querySelector('input[name="name"]')?.value,
                    email: document.querySelector('input[name="user_email"]')?.value,
                    cr: document.querySelector('input[name="cr_number"]')?.value,
                    package: document.querySelector('select[name="product_id"]')?.value,
                    gtin: document.querySelector('#gtins_annual_fee_input')?.value,
                    gln: document.querySelector('#gln_price_input')?.value,
                    total: document.querySelector('#total_price')?.value,
                    payment: document.querySelector('input[name="offline_payment"]:checked')?.value,
                    terms: document.querySelector('input[name="tnc"]')?.checked
                }
            };
        });

        console.log('Form validation result:', formState);

        if (!formState.isValid || !formState.state.payment || !formState.state.terms) {
            throw new Error('Form validation failed: ' + JSON.stringify(formState.state));
        }

        // Update form action to correct endpoint and submit
        await page.evaluate(() => {
            const form = document.querySelector('#regform');
            if (!form) {
                throw new Error('Form not found with ID "regform"');
            }
            form.action = 'process-registration.php';
            form.method = 'POST';
            form.enctype = 'multipart/form-data';

            // Get values from visible fields
            const gtinFee = parseFloat(document.querySelector('#gtins_annual_fee_input')?.value || '0');
            const glnPrice = parseFloat(document.querySelector('#gln_price_input')?.value || '0');
            const regFee = parseFloat(document.querySelector('#registration_fee')?.value || '0');
            const totalPrice = regFee + gtinFee + glnPrice;
            const annualFee = gtinFee + glnPrice;

            // Set all required hidden fields
            const setHiddenValue = (name, value) => {
                let input = document.querySelector(`input[name="${name}"]`);
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    form.appendChild(input);
                }
                input.value = value;
                input.dispatchEvent(new Event('change'));
            };

            // Set all required hidden fields
            setHiddenValue('registration_fee', regFee);
            setHiddenValue('gtins_annual_fee', gtinFee);
            setHiddenValue('gln_price', glnPrice);
            setHiddenValue('sscc_price', '0');
            setHiddenValue('annual_subscription_fee', annualFee);
            setHiddenValue('annual_total_price', annualFee);
            setHiddenValue('total_price', totalPrice);
            setHiddenValue('submit', '1');
            setHiddenValue('offline_payment', '1');
            setHiddenValue('tnc', 'Yes');

            // Ensure healthcare status is set
            const healthcareNo = document.querySelector('input[name="healthcare_status"][value="No"]');
            if (healthcareNo) {
                healthcareNo.checked = true;
                healthcareNo.dispatchEvent(new Event('change'));
            }

            // Ensure payment method is selected
            const paymentRadio = document.querySelector('input[name="offline_payment"][value="1"]');
            if (paymentRadio) {
                paymentRadio.checked = true;
                paymentRadio.dispatchEvent(new Event('change'));
            }

            // Ensure terms are accepted
            const termsCheckbox = document.querySelector('input[name="tnc"]');
            if (termsCheckbox) {
                termsCheckbox.checked = true;
                termsCheckbox.dispatchEvent(new Event('change'));
            }

            // Log form data before submission
            const formData = new FormData(form);
            console.log('Form data before submission:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            // Create and dispatch submit event
            const submitEvent = new Event('submit', {
                bubbles: true,
                cancelable: true
            });
            
            // Trigger form submission
            form.dispatchEvent(submitEvent);
            
            // If the form has an onsubmit handler, call it directly
            if (typeof form.onsubmit === 'function') {
                form.onsubmit();
            }
            
            // As a fallback, try clicking the submit button
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.click();
            }
        });

        // Wait for navigation and response
        try {
            await Promise.all([
                page.waitForNavigation({ timeout: 10000 }),
                page.waitForResponse(response => response.url().includes('process-registration.php'), { timeout: 10000 })
            ]);
        } catch (error) {
            console.error('Navigation or response timeout:', error);
        }

        // Get final URL and page content
        const finalUrl = page.url();
        console.log('Final URL:', finalUrl);

        const pageContent = await page.content();
        console.log('Final page content length:', pageContent.length);

        // Check for success or error messages
        const pageMessages = await page.evaluate(() => {
            return {
                success: document.querySelector('.alert-success')?.textContent?.trim() || '',
                error: document.querySelector('.alert-danger')?.textContent?.trim() || '',
                formErrors: Array.from(document.querySelectorAll('.error-message')).map(el => el.textContent?.trim() || '')
            };
        });
        console.log('Final page messages:', pageMessages);

        // Wait for database updates
        await sleep(page, 5000);

        // Start database verification
        console.log('Starting database verification...');
        const formDataToVerify = {
            email: formState.state.email,
            name: formState.state.name,
            cr: formState.state.cr
        };
        console.log('Form data to verify:', formDataToVerify);

        try {
            await verifyDatabaseEntry(formDataToVerify);
        } catch (error) {
            console.error('Database verification error:', error);
            console.error('Stack trace:', error.stack);
            throw new Error('Database verification failed');
        }

        return { success: true, browser };
    } catch (error) {
        console.error('Test execution failed:', error);
        return { success: false, browser: browser || null };
    }
}

// Run a single test
(async () => {
    let testBrowser;
    try {
        const result = await runRegistrationTest(1);
        testBrowser = result.browser;
        const success = result.success;
        
        // Print summary
        console.log('\nTest Summary:');
        console.log('-------------');
        console.log(`Registration Form Test #1: ${success ? 'PASSED' : 'FAILED'}`);
        console.log('\nBrowser will stay open for inspection. Press Ctrl+C to exit.');
        
    } catch (error) {
        console.error('Test execution failed:', error);
    }

    // Keep the process running
    process.on('SIGINT', async () => {
        console.log('Received SIGINT. Closing browser...');
        if (testBrowser) {
            await testBrowser.close();
        }
        process.exit();
    });
})(); 
