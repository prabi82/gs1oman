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
    // Generate exactly 8 digits for Tax Registration Number
    return generateRandomString(8, 'numeric');
}

function generateRandomVATNumber() {
    // Generate a valid VAT number format for Oman
    const prefix = 'OM'; // Oman prefix
    const numbers = generateRandomString(11, 'numeric');
    const suffix = generateRandomString(2, 'alpha').toUpperCase();
    return prefix + numbers + suffix;
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
    let formData;

    beforeAll(async () => {
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });
        page = await browser.newPage();

        // Enable console log capture
        page.on('console', msg => console.log('Browser Console:', msg.text()));

        // Add dialog handler
        page.on('dialog', async dialog => {
            console.log('Dialog appeared:', dialog.message());
            await dialog.accept();
        });
    });

    afterAll(async () => {
        if (browser) {
            await browser.close();
        }
    });

    test('Complete registration form submission', async () => {
        try {
            console.log('Starting registration form test...');

            // Navigate to the form
            await page.goto('http://localhost/gs1oman.com/index.php', {
                waitUntil: 'networkidle0',
                timeout: 60000
            });

            // Wait for form to be ready
            await page.waitForSelector('form', { timeout: 10000 });
            console.log('Form found, starting to fill data...');

            // Generate test data
            formData = {
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
                riyada_certificate: 'No',
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

            // Upload Documents
            const uploadPath = path.join(process.cwd(), 'test-files');
            const uploadFiles = {
                'upload_document1': path.join(uploadPath, 'cr.pdf'),      // Commercial Registration
                'upload_document2': path.join(uploadPath, 'coc.pdf'),     // Chamber of Commerce
                'upload_document3': path.join(uploadPath, 'other.pdf')    // Other Documents
            };

            // Handle file uploads one by one with proper waiting
            for (const [fieldName, filePath] of Object.entries(uploadFiles)) {
                // First make the file input visible and interactable
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
                const uploadInput = await page.waitForSelector(`input[name="${fieldName}"]`, { visible: true, timeout: 5000 });
                if (uploadInput) {
                    try {
                        await uploadInput.uploadFile(filePath);
                        
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

            // Select Package and Products
            await page.evaluate(() => {
                // Set hidden fields first
                const hiddenFields = {
                    'submit': '1',
                    'product_id': '1',
                    'product_name': 'Basic Package',
                    'registration_fee': '100',
                    'gtins_annual_fee': '200',
                    'gln_price': '50',
                    'sscc_price': '50'
                };
                
                // Create or update hidden fields
                for (const [name, value] of Object.entries(hiddenFields)) {
                    let input = document.querySelector(`input[name="${name}"]`);
                    if (!input) {
                        input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = name;
                        document.querySelector('form').appendChild(input);
                    }
                    input.value = value;
                }
                
                // Select package
                const packageSelect = document.querySelector('select[name="product_id"]');
                if (packageSelect) {
                    // Remove any disabled options
                    const disabledOption = packageSelect.querySelector('option[disabled]');
                    if (disabledOption) {
                        disabledOption.remove();
                    }
                    // Set value and trigger change event
                    packageSelect.value = '1';
                    packageSelect.dispatchEvent(new Event('change', { bubbles: true }));
                }
                
                // Set GTIN
                const gtinInput = document.querySelector('input[name="gtin"]');
                if (gtinInput) {
                    gtinInput.value = '350';
                    gtinInput.checked = true;
                    gtinInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
                
                // Set GLN
                const glnInput = document.querySelector('input[name="gln"]');
                if (glnInput) {
                    glnInput.value = '300';
                    glnInput.checked = true;
                    glnInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
                
                // Trigger price calculation
                const priceCalcEvent = new Event('priceCalculation', { bubbles: true });
                document.dispatchEvent(priceCalcEvent);
            });
            
            // Wait for package selection and price calculation
            await page.waitForFunction(
                () => {
                    const packageSelect = document.querySelector('select[name="product_id"]');
                    const priceElement = document.querySelector('#actual_package_price');
                    const gtinInput = document.querySelector('input[name="gtin"]');
                    const glnInput = document.querySelector('input[name="gln"]');
                    
                    const packageSelected = packageSelect && packageSelect.value === '1';
                    const priceCalculated = priceElement && priceElement.textContent.trim() !== '';
                    const gtinChecked = gtinInput && gtinInput.checked;
                    const glnChecked = glnInput && glnInput.checked;
                    
                    console.log('Package selected:', packageSelected);
                    console.log('Price calculated:', priceCalculated);
                    console.log('GTIN checked:', gtinChecked);
                    console.log('GLN checked:', glnChecked);
                    
                    return packageSelected && priceCalculated && gtinChecked && glnChecked;
                },
                { timeout: 10000 }
            );
            
            // Select Payment Method and Terms
            await page.evaluate(() => {
                // Select offline payment
                const paymentRadio = document.querySelector('input[name="offline_payment"][value="1"]');
                if (paymentRadio) {
                    paymentRadio.checked = true;
                    paymentRadio.dispatchEvent(new Event('change', { bubbles: true }));
                }
                
                // Accept terms
                const tncCheckbox = document.querySelector('input[name="tnc"]');
                if (tncCheckbox) {
                    tncCheckbox.checked = true;
                    tncCheckbox.value = 'Yes';
                    tncCheckbox.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });

            // Submit form
            console.log('Submitting form...');
            
            // Submit using form submit
            await page.evaluate(() => {
                const form = document.querySelector('form');
                if (form) {
                    // Log form data before submission
                    const formData = new FormData(form);
                    for (let [key, value] of formData.entries()) {
                        console.log('Form field:', key, '=', value);
                    }
                    
                    // Submit the form
                    form.submit();
                }
            });

            // Wait for navigation or response
            try {
                await Promise.race([
                    page.waitForNavigation({ waitUntil: 'networkidle0', timeout: 30000 }),
                    page.waitForResponse(
                        response => response.url().includes('index.php') && response.request().method() === 'POST',
                        { timeout: 30000 }
                    )
                ]);
                console.log('Form submitted successfully');
            } catch (error) {
                console.error('Form submission error:', error);
                throw error;
            }

        } catch (error) {
            console.error('Test failed:', error);
            throw error;
        }
    }, 300000); // 5 minute timeout

    test('VAT and Tax Registration Number validation', async () => {
        try {
            // Navigate to form
            await page.goto('http://localhost/gs1oman.com/index.php', {
                waitUntil: 'networkidle0',
                timeout: 60000
            });

            // Test invalid VAT number
            await page.type('input[name="vat_number"]', '123'); // Too short
            await page.type('input[name="cr_tax_registration_number"]', '123'); // Too short

            // Click submit and wait for validation
            const submitButton = await page.$('#reg_form_button');
            await submitButton.evaluate(button => button.click());
            
            // Wait for validation to complete
            await page.waitForFunction(() => {
                const vatInput = document.querySelector('input[name="vat_number"]');
                const taxInput = document.querySelector('input[name="cr_tax_registration_number"]');
                return vatInput && taxInput && 
                       (vatInput.validationMessage || taxInput.validationMessage);
            }, { timeout: 5000 });

            // Check validation messages
            const validation = await page.evaluate(() => {
                const vatInput = document.querySelector('input[name="vat_number"]');
                const taxInput = document.querySelector('input[name="cr_tax_registration_number"]');
                
                return {
                    vat: {
                        value: vatInput.value,
                        valid: vatInput.checkValidity(),
                        errorMessage: vatInput.validationMessage
                    },
                    tax: {
                        value: taxInput.value,
                        valid: taxInput.checkValidity(),
                        errorMessage: taxInput.validationMessage
                    }
                };
            });

            // Verify validation results
            expect(validation.vat.valid).toBeFalsy();
            expect(validation.tax.valid).toBeFalsy();

            // Test valid numbers
            await page.evaluate(() => {
                document.querySelector('input[name="vat_number"]').value = '';
                document.querySelector('input[name="cr_tax_registration_number"]').value = '';
            });

            const validVAT = generateRandomVATNumber();
            const validTax = generateRandomTaxNumber();

            await page.type('input[name="vat_number"]', validVAT);
            await page.type('input[name="cr_tax_registration_number"]', validTax);

            // Verify valid input acceptance
            const validationAfter = await page.evaluate(() => {
                const vatInput = document.querySelector('input[name="vat_number"]');
                const taxInput = document.querySelector('input[name="cr_tax_registration_number"]');
                
                return {
                    vat: {
                        value: vatInput.value,
                        valid: vatInput.checkValidity()
                    },
                    tax: {
                        value: taxInput.value,
                        valid: taxInput.checkValidity()
                    }
                };
            });

            expect(validationAfter.vat.valid).toBeTruthy();
            expect(validationAfter.tax.valid).toBeTruthy();

        } catch (error) {
            console.error('VAT and Tax validation test failed:', error);
            throw error;
        }
    }, 60000);
}); 
