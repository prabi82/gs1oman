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

describe('Registration Form Test', () => {
    let browser;
    let page;

    beforeAll(async () => {
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });
    });

    afterAll(async () => {
        await browser.close();
    });

    beforeEach(async () => {
        page = await browser.newPage();
        await page.setDefaultTimeout(30000);
        await page.setDefaultNavigationTimeout(30000);
    });

    afterEach(async () => {
        await page.close();
    });

    const runRegistrationTest = async (testNumber) => {
        console.log(`\n=== Starting Registration Test #${testNumber} ===\n`);
        try {
            // Navigate to the form
            await page.goto('http://localhost/gs1oman.com/index.php', {
                waitUntil: 'networkidle0',
                timeout: 60000
            });

            // Wait for form to be ready
            await page.waitForSelector('form', { timeout: 10000 });
            console.log('Form found, starting to fill data...');

            // Generate random emails first, before any other operations
            const timestamp = Date.now();
            const mainEmail = `test.user.${timestamp}.${Math.floor(Math.random() * 10000)}@example.com`;
            const additionalEmail = `test.user.${timestamp + 1}.${Math.floor(Math.random() * 10000)}@example.com`;

            console.log('Generated random emails:', { mainEmail, additionalEmail });

            // Fill in form fields with random emails first
            await page.evaluate(({ mainEmail, additionalEmail }) => {
                const fillField = (selector, value) => {
                    const field = document.querySelector(selector);
                    if (field) {
                        field.value = value;
                        field.dispatchEvent(new Event('input', { bubbles: true }));
                        field.dispatchEvent(new Event('change', { bubbles: true }));
                        if (typeof jQuery !== 'undefined') {
                            jQuery(field).trigger('change');
                        }
                    }
                };

                // Fill main contact details
                fillField('input[name="title_1"]', 'Mr.');
                fillField('input[name="fname_1"]', 'John');
                fillField('input[name="lname_1"]', 'Doe');
                fillField('input[name="job_title_1"]', 'CEO');
                fillField('input[name="email_1"]', mainEmail);
                fillField('input[name="phone_1"]', '96856644518');

                // Fill additional contact details
                fillField('input[name="title_2"]', 'Mrs.');
                fillField('input[name="fname_2"]', 'Jane');
                fillField('input[name="lname_2"]', 'Smith');
                fillField('input[name="job_title_2"]', 'Manager');
                fillField('input[name="email_2"]', additionalEmail);
                fillField('input[name="phone_2"]', '96898885641');

                // Select Riyada certificate as Yes
                const riyadaSelect = document.querySelector('#riyada_certificate');
                if (riyadaSelect) {
                    riyadaSelect.value = 'Yes';
                    riyadaSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    if (typeof jQuery !== 'undefined') {
                        jQuery(riyadaSelect).trigger('change');
                    }
                }

                // Set expiry date (1 year from now)
                const expDateInput = document.querySelector('#exp_date');
                if (expDateInput) {
                    const oneYearFromNow = new Date();
                    oneYearFromNow.setFullYear(oneYearFromNow.getFullYear() + 1);
                    const formattedDate = oneYearFromNow.toISOString().split('T')[0];
                    expDateInput.value = formattedDate;
                    expDateInput.dispatchEvent(new Event('change', { bubbles: true }));
                    if (typeof jQuery !== 'undefined') {
                        jQuery(expDateInput).trigger('change');
                    }
                }

            }, { mainEmail, additionalEmail });

            // Handle Riyada document upload
            const riyadaDocPath = path.join(__dirname, 'test-files', 'riyada-doc.pdf');
            const riyadaDocInput = await page.$('input[name="documents_req"]');
            if (riyadaDocInput) {
                await riyadaDocInput.uploadFile(riyadaDocPath);
                await page.evaluate(() => {
                    const input = document.querySelector('input[name="documents_req"]');
                    if (input) {
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                        if (typeof jQuery !== 'undefined') {
                            jQuery(input).trigger('change');
                        }
                    }
                });
            }

            // Wait for any potential AJAX requests to complete
            await page.waitForNavigation({ waitUntil: 'networkidle0', timeout: 5000 }).catch(() => {
                // Ignore timeout error as there might not be any navigation
                console.log('No navigation occurred after email input');
            });

            // Check for any duplicate email errors
            const emailErrors = await page.evaluate(() => {
                const errorElements = document.querySelectorAll('.alert-danger, .error-message');
                const errors = Array.from(errorElements)
                    .map(el => el.textContent)
                    .filter(text => text.toLowerCase().includes('email') && text.toLowerCase().includes('exist'));
                
                if (errors.length > 0) {
                    console.log('Found email errors:', errors);
                }
                return errors;
            });

            if (emailErrors.length > 0) {
                console.log('Duplicate email errors found:', emailErrors);
                throw new Error('Duplicate email detected: ' + emailErrors.join(', '));
            }

            // Generate test data
            const formData = {
                // Company Information
                name: generateRandomCompanyName(),
                name_ar: generateRandomArabicName() + ' للتجارة',
                cr_number: generateRandomCRNumber(),
                pobox: Math.floor(10000 + Math.random() * 90000).toString(),
                zipcode: Math.floor(100 + Math.random() * 900).toString(),
                address: generateRandomAddress(),
                address_ar: 'مبنى ' + Math.floor(Math.random() * 999) + '، طريق ' + Math.floor(Math.random() * 9999),
                country: 'Oman',
                city: 'Muscat',
                mobile_number: generateRandomPhone(),
                phone_number: generateRandomPhone(),
                user_email: generateRandomEmail(),

                // CR Details
                riyada_certificate: 'Yes',
                cr_registration_date: new Date().toISOString().split('T')[0],
                cr_expiry_date: new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                cr_legal_type: 'Limited Liability Company - LLC',
                cr_tax_registration_number: generateRandomTaxNumber(),
                vat_number: generateRandomVATNumber(),

                // Business Details
                business_type_product_category: 'Food',
                number_of_employee: '50',
                
                // Contact Person Details
                contact_persons: [
                    {
                        title: 'Mr.',
                        first_name: 'John',
                        last_name: 'Doe',
                        job_title: 'CEO',
                        email: generateRandomEmail('john.doe'),
                        phone: generateRandomPhone()
                    },
                    {
                        title: 'Mrs.',
                        first_name: 'Jane',
                        last_name: 'Smith',
                        job_title: 'Manager',
                        email: generateRandomEmail('jane.smith'),
                        phone: generateRandomPhone()
                    }
                ]
            };

            // Fill Company Information
            await page.type('input[name="name"]', formData.name);
            await page.type('input[name="name_ar"]', formData.name_ar);
            await page.type('input[name="cr_number"]', formData.cr_number);
            await page.type('input[name="pobox"]', formData.pobox);
            await page.type('input[name="zipcode"]', formData.zipcode);
            await page.type('input[name="address"]', formData.address);
            await page.type('input[name="address_ar"]', formData.address_ar);
            await page.select('select[name="country"]', formData.country);
            await page.select('select[name="city"]', formData.city);
            await page.type('input[name="mobile_number"]', formData.mobile_number);
            await page.type('input[name="phone_number"]', formData.phone_number);
            await page.type('input[name="user_email"]', formData.user_email);

            // Fill Other Details
            await page.select('select[name="riyada_certificate"]', formData.riyada_certificate);
            
            // Fill CR Details in specific order
            await page.evaluate((data) => {
                const regDateInput = document.querySelector('input[name="cr_registration_date"]');
                const expDateInput = document.querySelector('input[name="cr_expiry_date"]');
                if (regDateInput) regDateInput.value = data.cr_registration_date;
                if (expDateInput) expDateInput.value = data.cr_expiry_date;
                
                // Trigger change events
                [regDateInput, expDateInput].forEach(input => {
                    if (input) {
                        const event = new Event('change', { bubbles: true });
                        input.dispatchEvent(event);
                    }
                });
            }, formData);

            await page.select('select[name="cr_legal_type"]', formData.cr_legal_type);
            await page.type('input[name="cr_tax_registration_number"]', formData.cr_tax_registration_number);
            await page.type('input[name="vat_number"]', formData.vat_number);

            // Fill Business Details
            await page.evaluate((category) => {
                const select = document.querySelector('select[name="business_type_product_category"]');
                if (select) {
                    // Remove the disabled selected option
                    const disabledOption = select.querySelector('option[disabled]');
                    if (disabledOption) {
                        disabledOption.remove();
                    }
                    // Set the value and trigger change event
                    select.value = category;
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    // Also trigger jQuery change event if jQuery is present
                    if (typeof jQuery !== 'undefined') {
                        jQuery(select).trigger('change');
                    }
                    console.log('Business type set to:', select.value);
                }
            }, formData.business_type_product_category);

            // Wait for the value to be set
            await page.waitForFunction(
                (category) => {
                    const select = document.querySelector('select[name="business_type_product_category"]');
                    return select && select.value === category;
                },
                { timeout: 5000 },
                formData.business_type_product_category
            );

            // Verify the value was set
            const businessType = await page.evaluate(() => {
                const select = document.querySelector('select[name="business_type_product_category"]');
                return select ? select.value : null;
            });
            console.log('Verified business type:', businessType);
            
            await page.type('input[name="number_of_employee"]', formData.number_of_employee);

            // Handle any modal that might appear
            await handleModal(page);

            // Set healthcare status
            await page.evaluate(() => {
                const noRadio = document.querySelector('input[name="healthcare_status"][value="NO"]');
                if (noRadio) noRadio.click();
            });

            // Fill Primary Contact Person
            await page.select('select[name="title[]"]', formData.contact_persons[0].title);
            await page.type('input[name="first_name[]"]', formData.contact_persons[0].first_name);
            await page.type('input[name="last_name[]"]', formData.contact_persons[0].last_name);
            await page.type('input[name="job_title[]"]', formData.contact_persons[0].job_title);
            await page.type('input[name="email_id[]"]', formData.contact_persons[0].email);
            await page.type('input[name="phone_number1[]"]', formData.contact_persons[0].phone);

            // Add and fill Secondary Contact Person
            await page.evaluate(() => {
                const addButton = document.querySelector('.add-more-contact');
                if (addButton) addButton.click();
            });
            
            // Wait for new contact fields to be added
            await page.waitForFunction(() => {
                const titles = document.querySelectorAll('select[name="title[]"]');
                return titles.length > 1;
            }, { timeout: 5000 });

            // Fill Secondary Contact Person
            await page.evaluate((data) => {
                // Set title for second contact person
                const titles = document.querySelectorAll('select[name="title[]"]');
                if (titles[1]) {
                    titles[1].value = data.title;
                    // Trigger change event
                    const event = new Event('change', { bubbles: true });
                    titles[1].dispatchEvent(event);
                }
            }, formData.contact_persons[1]);

            const inputs = {
                'first_name[]': formData.contact_persons[1].first_name,
                'last_name[]': formData.contact_persons[1].last_name,
                'job_title[]': formData.contact_persons[1].job_title,
                'email_id[]': formData.contact_persons[1].email,
                'phone_number1[]': formData.contact_persons[1].phone
            };

            for (const [name, value] of Object.entries(inputs)) {
                const elements = await page.$$(`input[name="${name}"]`);
                if (elements.length > 1) {
                    await elements[1].type(value);
                }
            }

            // Verify contact person fields
            const contactFieldsVerified = await page.evaluate(() => {
                const fields = ['first_name[]', 'last_name[]', 'job_title[]', 'email_id[]', 'phone_number1[]'];
                return fields.every(field => {
                    const inputs = document.querySelectorAll(`input[name="${field}"]`);
                    return Array.from(inputs).every(input => input.value);
                });
            });

            console.log('Contact person fields verified:', contactFieldsVerified);

            // Upload test files
            const uploadPath = path.join(process.cwd(), 'test-files');
            const uploadFiles = {
                'upload_document1': path.join(uploadPath, 'cr.pdf'),
                'upload_document2': path.join(uploadPath, 'coc.pdf'),
                'upload_document3': path.join(uploadPath, 'other.pdf')
            };

            // Handle file uploads one by one with proper waiting
            for (const [fieldName, filePath] of Object.entries(uploadFiles)) {
                const fileInput = await page.$(`input[name="${fieldName}"]`);
                if (fileInput) {
                    // Make file input visible and interactable
                    await page.evaluate((selector) => {
                        const input = document.querySelector(`input[name="${selector}"]`);
                        if (input) {
                            input.style.cssText = 'display: block !important; opacity: 1 !important; visibility: visible !important; position: relative !important;';
                            input.removeAttribute('class');
                            // Also make parent elements visible if they're hiding the input
                            let parent = input.parentElement;
                            while (parent) {
                                parent.style.cssText = 'display: block !important; opacity: 1 !important; visibility: visible !important; position: relative !important;';
                                parent = parent.parentElement;
                            }
                        }
                    }, fieldName);

                    // Wait for the input to be ready
                    await page.waitForSelector(`input[name="${fieldName}"]`, { visible: true, timeout: 5000 });
                    
                    try {
                        await fileInput.uploadFile(filePath);

                        // Wait for file to be selected
                        await page.waitForFunction(
                            (name) => {
                                const input = document.querySelector(`input[name="${name}"]`);
                                return input && input.files && input.files.length > 0;
                            },
                            { timeout: 5000 },
                            fieldName
                        );

                        // Verify file was uploaded
                        const fileSelected = await page.evaluate((name) => {
                            const input = document.querySelector(`input[name="${name}"]`);
                            return input && input.files && input.files[0] ? input.files[0].name : null;
                        }, fieldName);

                        console.log(`File uploaded for ${fieldName}:`, fileSelected);

                        // Trigger change and input events
                        await page.evaluate((name) => {
                            const input = document.querySelector(`input[name="${name}"]`);
                            if (input) {
                                ['change', 'input'].forEach(eventType => {
                                    const event = new Event(eventType, { bubbles: true });
                                    input.dispatchEvent(event);
                                });
                            }
                        }, fieldName);

                    } catch (error) {
                        console.error(`Failed to upload file for ${fieldName}:`, error);
                        throw error;
                    }
                } else {
                    console.error(`Upload input not found for ${fieldName}`);
                    throw new Error(`Upload input not found for ${fieldName}`);
                }
            }

            // Additional verification of uploads
            const uploadsVerified = await page.evaluate(() => {
                const requiredUploads = ['upload_document1', 'upload_document2', 'upload_document3'];
                return requiredUploads.every(name => {
                    const input = document.querySelector(`input[name="${name}"]`);
                    return input && input.files && input.files.length > 0;
                });
            });

            if (!uploadsVerified) {
                throw new Error('Document uploads verification failed');
            }

            console.log('All documents uploaded successfully');

            // First check available packages and log them
            const availablePackages = await page.evaluate(() => {
                const packageSelect = document.querySelector('select[name="product_id"]');
                if (!packageSelect) {
                    console.log('Package select element not found');
                    return null;
                }
                
                // Log all available options
                const options = Array.from(packageSelect.options).map(opt => ({
                    value: opt.value,
                    text: opt.text,
                    disabled: opt.disabled
                }));
                console.log('Available packages:', options);
                return options;
            });
            console.log('Found packages:', availablePackages);

            // Select package and trigger change events
            await page.evaluate(() => {
                return new Promise((resolve) => {
                    const packageSelect = document.querySelector('select[name="product_id"]');
                    if (!packageSelect) {
                        console.log('Package select not found');
                        return resolve(false);
                    }

                    // Remove any disabled options
                    packageSelect.querySelectorAll('option[disabled]').forEach(opt => opt.remove());
                    
                    // Set the value to 3 (which is the option with text "1000")
                    packageSelect.value = '3';
                    console.log('Set package value to:', packageSelect.value);
                    
                    // Create and dispatch change event
                    const changeEvent = new Event('change', { bubbles: true });
                    packageSelect.dispatchEvent(changeEvent);
                    
                    // If jQuery is available, trigger its change event
                    if (typeof jQuery !== 'undefined') {
                        jQuery(packageSelect).trigger('change');
                        console.log('jQuery change event triggered');
                    }
                    
                    // If show_package_details exists, call it
                    if (typeof show_package_details === 'function') {
                        show_package_details();
                        console.log('show_package_details function called');
                    }
                    
                    // Select Cash payment option
                    const cashRadio = document.querySelector('input[type="radio"][name="offline_payment"][value="1"].tick');
                    if (cashRadio) {
                        console.log('Found Cash payment radio button');
                        cashRadio.click();
                        cashRadio.checked = true;
                        ['change', 'input', 'click'].forEach(eventType => {
                            const event = new Event(eventType, { bubbles: true });
                            cashRadio.dispatchEvent(event);
                        });
                        if (typeof jQuery !== 'undefined') {
                            jQuery(cashRadio).trigger('change').trigger('click');
                        }
                        console.log('Cash payment selected:', cashRadio.checked);
                    } else {
                        console.error('Cash payment radio button not found');
                    }
                    
                    // Give a small delay for events to process
                    setTimeout(() => {
                        const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                        console.log('Final package selection:', {
                            value: packageSelect.value,
                            text: selectedOption?.text,
                            index: packageSelect.selectedIndex
                        });
                        resolve(true);
                    }, 500);
                });
            });

            // Wait for package details AJAX request
            console.log('Waiting for package details AJAX request...');
            try {
                // Set up dialog handler that removes itself after first use
                let dialogHandled = false;
                const dialogHandler = async (dialog) => {
                    if (dialogHandled) {
                        return;
                    }
                    dialogHandled = true;
                    console.log('Dialog appeared:', dialog.message());
                    await dialog.accept();
                    page.off('dialog', dialogHandler);
                };
                page.on('dialog', dialogHandler);

                // First trigger the package change
                await page.evaluate(() => {
                    if (typeof jQuery !== 'undefined') {
                        jQuery('#package').trigger('change');
                        console.log('Package change event triggered');
                    }
                    
                    // If show_package_details exists, call it
                    if (typeof show_package_details === 'function') {
                        show_package_details();
                        console.log('show_package_details function called');
                    }
                });

                // Wait for AJAX response
                const response = await Promise.race([
                    page.waitForResponse(
                        response => response.url().includes('get_package_details.php'),
                        { timeout: 30000 }
                    ),
                    page.waitForResponse(
                        response => response.url().includes('check_duplicate.php'),
                        { timeout: 30000 }
                    )
                ]);

                console.log('Response received from:', response.url());
                
                // Log response status and content
                console.log('Response status:', response.status());
                const responseText = await response.text();
                console.log('Response content:', responseText);

                // Wait for checkboxes to be present in the DOM
                await page.waitForSelector('input[name="gtin"], #gtins_annual_fee', { timeout: 30000 });
                await page.waitForSelector('input[name="gln"], #gln_annual_fee', { timeout: 30000 });

                // Check if checkboxes exist and are visible
                const checkboxesExist = await page.evaluate(() => {
                    const gtinCheckbox = document.querySelector('input[name="gtin"], #gtins_annual_fee');
                    const glnCheckbox = document.querySelector('input[name="gln"], #gln_annual_fee');
                    
                    console.log('Checkbox existence check:', {
                        gtin: gtinCheckbox ? {
                            name: gtinCheckbox.name,
                            id: gtinCheckbox.id,
                            value: gtinCheckbox.value,
                            visible: gtinCheckbox.offsetParent !== null
                        } : null,
                        gln: glnCheckbox ? {
                            name: glnCheckbox.name,
                            id: glnCheckbox.id,
                            value: glnCheckbox.value,
                            visible: glnCheckbox.offsetParent !== null
                        } : null
                    });
                    
                    return {
                        gtin: !!gtinCheckbox,
                        gln: !!glnCheckbox
                    };
                });

                console.log('Checkboxes exist:', checkboxesExist);

                if (!checkboxesExist.gtin || !checkboxesExist.gln) {
                    throw new Error('Checkboxes not found after AJAX response');
                }

                // Now try to select the checkboxes
                const productSelections = await page.evaluate(() => {
                    const results = { gtin: false, gln: false };
                    
                    // Function to click checkbox and verify
                    const clickAndVerifyCheckbox = (checkbox) => {
                        if (!checkbox) return false;
                        
                        console.log('Attempting to click checkbox:', {
                            before: {
                                name: checkbox.name,
                                id: checkbox.id,
                                value: checkbox.value,
                                checked: checkbox.checked,
                                disabled: checkbox.disabled
                            }
                        });

                        // First try native click
                        checkbox.click();
                        console.log('After native click:', checkbox.checked);
                        
                        // If not checked, try programmatic check
                        if (!checkbox.checked) {
                            checkbox.checked = true;
                            // Trigger change event to call the add() function
                            const changeEvent = new Event('change', { bubbles: true });
                            checkbox.dispatchEvent(changeEvent);
                            console.log('After programmatic check:', checkbox.checked);
                        }
                        
                        // If jQuery available, trigger change event
                        if (typeof jQuery !== 'undefined') {
                            jQuery(checkbox).trigger('change');
                            console.log('After jQuery events:', checkbox.checked);
                        }

                        // Call add() function directly if it exists
                        if (typeof add === 'function') {
                            add();
                            console.log('Called add() function directly');
                        }
                        
                        return checkbox.checked;
                    };

                    // Find and click GTIN checkbox
                    const gtinCheckbox = document.querySelector('input[name="gtin"], #gtins_annual_fee');
                    if (gtinCheckbox) {
                        console.log('Found GTIN checkbox:', {
                            name: gtinCheckbox.name,
                            id: gtinCheckbox.id,
                            value: gtinCheckbox.value
                        });
                        results.gtin = clickAndVerifyCheckbox(gtinCheckbox);
                        console.log('GTIN checkbox final state:', results.gtin);
                    } else {
                        console.log('GTIN checkbox not found');
                    }

                    // Find and click GLN checkbox
                    const glnCheckbox = document.querySelector('input[name="gln"], #gln_annual_fee');
                    if (glnCheckbox) {
                        console.log('Found GLN checkbox:', {
                            name: glnCheckbox.name,
                            id: glnCheckbox.id,
                            value: glnCheckbox.value
                        });
                        results.gln = clickAndVerifyCheckbox(glnCheckbox);
                        console.log('GLN checkbox final state:', results.gln);
                    } else {
                        console.log('GLN checkbox not found');
                    }

                    // Final verification
                    console.log('Final selection results:', results);
                    return results;
                });

                console.log('Product selections result:', productSelections);
                
                if (!productSelections.gtin || !productSelections.gln) {
                    throw new Error(`Failed to select products. GTIN: ${productSelections.gtin}, GLN: ${productSelections.gln}`);
                }

                // Wait for fee values to update after checkbox selection
                console.log('Waiting for fee values to update...');
                await page.evaluate(() => {
                    return new Promise((resolve) => {
                        // First check current values
                        const checkFeeValues = () => {
                            const feeInputs = {
                                registration_fee: document.querySelector('input[name="registration_fee"], #registration_fee'),
                                annual_fee: document.querySelector('input[name="annual_total_price"], #annual_subscription_fee'),
                                total_price: document.querySelector('input[name="total_price"], #total_price')
                            };

                            // Log current values
                            Object.entries(feeInputs).forEach(([key, input]) => {
                                if (input) {
                                    console.log(`${key} current value:`, input.value);
                                }
                            });

                            // Check if values are valid
                            const hasValidValues = Object.values(feeInputs).every(input => 
                                input && input.value && !isNaN(parseFloat(input.value)) && parseFloat(input.value) > 0
                            );

                            return hasValidValues;
                        };

                        // If values are already valid, resolve immediately
                        if (checkFeeValues()) {
                            resolve(true);
                            return;
                        }

                        // Otherwise, set up an interval to check
                        const intervalId = setInterval(() => {
                            if (checkFeeValues()) {
                                clearInterval(intervalId);
                                resolve(true);
                            }
                        }, 500);

                        // Set a timeout to prevent infinite waiting
                        setTimeout(() => {
                            clearInterval(intervalId);
                            resolve(false);
                        }, 5000);
                    });
                });

                // Accept terms and conditions
                console.log('Accepting terms and conditions...');
                await page.evaluate(() => {
                    return new Promise((resolve) => {
                        const acceptTerms = () => {
                            // First try clicking the agree button
                            const agreeButton = document.querySelector('#agree');
                            if (agreeButton) {
                                agreeButton.click();
                                console.log('Clicked agree button');
                            }

                            // Get the checkbox
                            const termsCheckbox = document.querySelector('#finalpay1');
                            if (!termsCheckbox) {
                                console.error('Terms checkbox not found');
                                return false;
                            }

                            // Log initial state
                            console.log('Terms checkbox initial state:', {
                                checked: termsCheckbox.checked,
                                disabled: termsCheckbox.disabled,
                                value: termsCheckbox.value,
                                name: termsCheckbox.name,
                                id: termsCheckbox.id,
                                class: termsCheckbox.className
                            });

                            // If not checked by agree button, try direct methods
                            if (!termsCheckbox.checked) {
                                // Make sure it's visible and enabled
                                termsCheckbox.style.cssText = 'display: block !important; opacity: 1 !important; visibility: visible !important;';
                                termsCheckbox.disabled = false;

                                // Check it
                                termsCheckbox.checked = true;

                                // Trigger events in the right order
                                if (typeof jQuery !== 'undefined') {
                                    // Use jQuery to trigger events as the site uses jQuery
                                    jQuery(termsCheckbox)
                                        .prop('checked', true)
                                        .trigger('click')
                                        .trigger('change');
                                } else {
                                    // Fallback to native events
                                    termsCheckbox.dispatchEvent(new MouseEvent('click', {
                                        view: window,
                                        bubbles: true,
                                        cancelable: true
                                    }));
                                    termsCheckbox.dispatchEvent(new Event('change', { bubbles: true }));
                                }
                            }

                            // Log final state
                            console.log('Terms checkbox final state:', {
                                checked: termsCheckbox.checked,
                                disabled: termsCheckbox.disabled,
                                value: termsCheckbox.value,
                                name: termsCheckbox.name,
                                id: termsCheckbox.id,
                                class: termsCheckbox.className
                            });

                            return termsCheckbox.checked;
                        };

                        // Set up alert handler
                        const originalAlert = window.alert;
                        window.alert = (message) => {
                            console.log('Alert message:', message);
                            // Restore original alert after handling
                            window.alert = originalAlert;
                        };

                        // Try to accept terms
                        if (acceptTerms()) {
                            resolve(true);
                            return;
                        }

                        // If not successful, retry a few times
                        let attempts = 0;
                        const intervalId = setInterval(() => {
                            attempts++;
                            if (acceptTerms() || attempts >= 5) {
                                clearInterval(intervalId);
                                resolve(true);
                            }
                        }, 500);

                        // Set a timeout to prevent infinite waiting
                        setTimeout(() => {
                            clearInterval(intervalId);
                            resolve(false);
                        }, 5000);
                    });
                });

                // Select healthcare status radio button
                console.log('Selecting healthcare status...');
                await page.evaluate(() => {
                    const healthcareRadio = document.querySelector('input[name="healthcare_status"][value="Yes"]');
                    if (!healthcareRadio) {
                        console.error('Healthcare radio button not found');
                        return false;
                    }

                    // Log initial state
                    console.log('Healthcare radio initial state:', {
                        checked: healthcareRadio.checked,
                        disabled: healthcareRadio.disabled,
                        value: healthcareRadio.value,
                        name: healthcareRadio.name,
                        class: healthcareRadio.className
                    });

                    // Click the radio button
                    healthcareRadio.click();
                    healthcareRadio.checked = true;

                    // Trigger events
                    if (typeof jQuery !== 'undefined') {
                        jQuery(healthcareRadio)
                            .prop('checked', true)
                            .trigger('click')
                            .trigger('change');
                    } else {
                        healthcareRadio.dispatchEvent(new MouseEvent('click', {
                            view: window,
                            bubbles: true,
                            cancelable: true
                        }));
                        healthcareRadio.dispatchEvent(new Event('change', { bubbles: true }));
                    }

                    // Log final state
                    console.log('Healthcare radio final state:', {
                        checked: healthcareRadio.checked,
                        disabled: healthcareRadio.disabled,
                        value: healthcareRadio.value,
                        name: healthcareRadio.name,
                        class: healthcareRadio.className
                    });

                    return healthcareRadio.checked;
                });

                // Handle any alert that might appear
                page.on('dialog', async (dialog) => {
                    console.log('Dialog message:', dialog.message());
                    await dialog.accept();
                });

                // Short delay before proceeding
                await new Promise(resolve => setTimeout(resolve, 500));

            } catch (error) {
                console.error('Error during package selection:', error);
                throw error;
            }

            // Submit form and wait for response
            await Promise.all([
                page.evaluate(() => {
                    console.log('Form submission started');
                    const form = document.querySelector('form');
                    if (!form) {
                        throw new Error('Form not found');
                    }
                    
                    // Log form data before submission
                    const formData = new FormData(form);
                    console.log('Form data before submission:');
                    for (let [key, value] of formData.entries()) {
                        console.log(`${key}: ${value}`);
                    }
                    
                    // Try to find the submit button
                    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
                    if (submitButton) {
                        submitButton.click();
                    } else {
                        // If no submit button found, try to trigger form submission directly
                        const submitEvent = new Event('submit', { bubbles: true, cancelable: true });
                        form.dispatchEvent(submitEvent);
                    }
                }),
                page.waitForNavigation({ waitUntil: 'networkidle0', timeout: 30000 })
            ]);

            // Wait for success message or error
            await Promise.race([
                page.waitForSelector('.alert-success', { timeout: 5000 }),
                page.waitForSelector('.alert-danger', { timeout: 5000 })
            ]).catch(() => {
                console.log('No success/error message found, continuing...');
            });

            // Check for validation errors
            const errors = await page.evaluate(() => {
                const errorElements = document.querySelectorAll('.error, .alert-danger');
                return Array.from(errorElements).map(el => el.textContent);
            });

            if (errors.length > 0) {
                console.log('Validation errors found:', errors);
                throw new Error('Form validation failed: ' + errors.join(', '));
            }

            // Verify submission by checking URL or success message
            const currentUrl = page.url();
            expect(currentUrl).toContain('thanks.php');

            // Optional: Verify database entry
            const connection = await mysql.createConnection({
                host: 'localhost',
                user: 'root',
                password: '',
                database: 'gs1omancom_barcode'
            });

            try {
                const [rows] = await connection.execute(
                    'SELECT * FROM company_tbl WHERE name = ? AND cr_number = ? ORDER BY id DESC LIMIT 1',
                    [formData.name, formData.cr_number]
                );

                expect(rows.length).toBeGreaterThan(0);
                console.log('Registration successful. Database entry verified.');
            } finally {
                await connection.end();
            }

            console.log(`\n=== Registration Test #${testNumber} Completed Successfully ===\n`);
            return true;
        } catch (error) {
            console.error(`\n=== Registration Test #${testNumber} Failed ===`);
            console.error('Error:', error);
            return false;
        }
    };

    test('Multiple registration form submissions for consistency', async () => {
        const numberOfTests = 3;
        const results = [];

        for (let i = 1; i <= numberOfTests; i++) {
            const success = await runRegistrationTest(i);
            results.push({ testNumber: i, success });
            
            // Wait between tests to avoid overwhelming the server
            if (i < numberOfTests) {
                console.log('\nWaiting 5 seconds before next test...\n');
                await new Promise(resolve => setTimeout(resolve, 5000));
            }
        }

        // Log final results
        console.log('\n=== Final Test Results ===');
        results.forEach(result => {
            console.log(`Test #${result.testNumber}: ${result.success ? 'PASSED' : 'FAILED'}`);
        });

        // Calculate success rate
        const successRate = (results.filter(r => r.success).length / numberOfTests) * 100;
        console.log(`\nSuccess Rate: ${successRate}%`);

        // Ensure all tests passed
        const allPassed = results.every(r => r.success);
        expect(allPassed).toBe(true);
    }, 180000); // Increased timeout for multiple tests
}); 
