import puppeteer from 'puppeteer';
import mysql from 'mysql2/promise';

// Helper functions for generating random data
function generateRandomString(length) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
}

function generateRandomGLN() {
    // Generate a random 13-digit GLN number
    let gln = '6281';  // GS1 prefix for Oman
    for(let i = 0; i < 8; i++) {
        gln += Math.floor(Math.random() * 10);
    }
    // Add check digit
    let sum = 0;
    for(let i = 0; i < 12; i++) {
        sum += parseInt(gln[i]) * (i % 2 === 0 ? 1 : 3);
    }
    const checkDigit = (10 - (sum % 10)) % 10;
    return gln + checkDigit;
}

function generateRandomCoordinate(isLongitude = false) {
    // Generate random coordinates within Oman's boundaries
    // Oman's approximate boundaries:
    // Longitude: 52° to 60° E
    // Latitude: 16° to 27° N
    const min = isLongitude ? 52 : 16;
    const max = isLongitude ? 60 : 27;
    return (Math.random() * (max - min) + min).toFixed(6);
}

function generateRandomLocation() {
    const locations = [
        'Main Office', 'Warehouse', 'Distribution Center', 'Retail Store',
        'Manufacturing Plant', 'Storage Facility', 'Branch Office', 'Logistics Hub'
    ];
    return locations[Math.floor(Math.random() * locations.length)];
}

async function fillFormWithRandomData(page) {
    // ... existing fillFormWithRandomData function ...

    // Set Riyada certificate value
    await page.evaluate(() => {
        const select = document.querySelector('select[name="riyada_certificate"]');
        if (select) {
            select.value = 'Yes';
            select.dispatchEvent(new Event('change'));
            
            // Set expiry date if Riyada certificate is Yes
            const expDate = new Date();
            expDate.setFullYear(expDate.getFullYear() + 1);
            const expInput = document.querySelector('input[name="exp_date"]');
            if (expInput) {
                expInput.value = expDate.toISOString().split('T')[0];
                expInput.dispatchEvent(new Event('change'));
            }
        }
    });
    
    // ... existing fillFormWithRandomData function ...
}

async function verifyDatabaseEntry(formData) {
    // ... existing verifyDatabaseEntry function ...
}

async function fillGLNForm(page) {
    try {
        // Wait for the form to be loaded
        await page.waitForSelector('#gln-form', { timeout: 10000 });
        console.log('GLN form found, starting to fill...');

        // Fill the first GLN form
        await page.type('input[name="gln_data[0][gln_number]"]', generateRandomGLN());
        await page.type('input[name="gln_data[0][location_name]"]', generateRandomLocation());
        await page.type('input[name="gln_data[0][longitude]"]', generateRandomCoordinate(true));
        await page.type('input[name="gln_data[0][latitude]"]', generateRandomCoordinate(false));

        // Add two more GLN forms
        for(let i = 0; i < 2; i++) {
            await page.click('#add-more');
            await page.waitForTimeout(500); // Wait for the new form to be added

            const index = i + 1;
            await page.type(`input[name="gln_data[${index}][gln_number]"]`, generateRandomGLN());
            await page.type(`input[name="gln_data[${index}][location_name]"]`, generateRandomLocation());
            await page.type(`input[name="gln_data[${index}][longitude]"]`, generateRandomCoordinate(true));
            await page.type(`input[name="gln_data[${index}][latitude]"]`, generateRandomCoordinate(false));
        }

        console.log('Form filled successfully');
        return true;
    } catch (error) {
        console.error('Error filling GLN form:', error);
        return false;
    }
}

// Main test function
async function runTest(testNumber) {
    let browser;
    let page;
    let formData;
    
    try {
        console.log(`\nStarting GLN Form Fill Test #${testNumber}`);
        
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });

        page = await browser.newPage();
        page.on('console', msg => console.log('Browser console:', msg.text()));

        // First login to admin panel
        await page.goto('http://localhost/gs1oman.com/admin/login.php', {
            waitUntil: 'networkidle0',
            timeout: 60000
        });

        // Login with admin credentials
        await page.type('input[name="email"]', 'admin@gs1oman.com');
        await page.type('input[name="password"]', 'admin123');
        await page.click('button[type="submit"]');

        // Wait for login and navigation
        await page.waitForNavigation();

        // Navigate to the GLN generation page
        // Note: Replace 69 with an actual order ID that exists in your system
        await page.goto('http://localhost/gs1oman.com/admin/product/generate_multiple_gln.php?id=69&page=PROT', {
            waitUntil: 'networkidle0',
            timeout: 60000
        });

        const success = await fillGLNForm(page);
        
        if (success) {
            // Submit the form
            await page.click('#generate-btn');
            
            // Wait for the response
            await page.waitForTimeout(2000);
            
            // Check for success message
            const alertText = await page.$eval('#alert-container', el => el.textContent);
            const isSuccess = alertText.includes('successfully');
            
            console.log(`Form Fill Test #${testNumber}: ${isSuccess ? 'PASSED' : 'FAILED'}`);
            return { success: isSuccess, browser };
        } else {
            console.log(`Form Fill Test #${testNumber}: FAILED`);
            return { success: false, browser };
        }
    } catch (error) {
        console.error('Test execution failed:', error);
        return { success: false, browser: browser || null };
    }
}

// Run a single test
(async () => {
    let testBrowser;
    try {
        const result = await runTest(1);
        testBrowser = result.browser;
        const success = result.success;
        
        // Print summary
        console.log('\nTest Summary:');
        console.log('-------------');
        console.log(`GLN Form Fill Test #1: ${success ? 'PASSED' : 'FAILED'}`);
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