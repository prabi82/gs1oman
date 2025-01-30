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

// ... rest of the helper functions ...

async function fillFormWithRandomData(page) {
    // ... existing fillFormWithRandomData function ...
}

async function verifyDatabaseEntry(formData) {
    // ... existing verifyDatabaseEntry function ...
}

// Main test function
async function runTest(testNumber) {
    let browser;
    let page;
    let formData;
    
    try {
        console.log(`\nStarting Form Fill Test #${testNumber}`);
        
        browser = await puppeteer.launch({
            headless: false,
            defaultViewport: null,
            args: ['--start-maximized']
        });

        page = await browser.newPage();
        page.on('console', msg => console.log('Browser console:', msg.text()));

        await page.goto('http://localhost/gs1oman.com/index.php', {
            waitUntil: 'networkidle0',
            timeout: 60000
        });

        await page.waitForSelector('form', { timeout: 10000 });
        console.log('Form found, starting to fill with random data...');

        const success = await fillFormWithRandomData(page);
        
        if (success) {
            // Store form data for database verification
            formData = await page.evaluate(() => {
                return {
                    name: document.querySelector('input[name="name"]').value,
                    user_email: document.querySelector('input[name="user_email"]').value
                };
            });

            // Submit the form directly using JavaScript
            await page.evaluate(() => {
                // Set any required hidden fields
                const hiddenFields = {
                    'submit': '1',
                    'tnc': 'Yes'
                };

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

                // Get the form data
                const form = document.querySelector('form');
                const formData = new FormData(form);

                // Submit using fetch
                return fetch(form.action, {
                    method: 'POST',
                    body: formData
                });
            });
            
            // Wait briefly for the submission to process
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            // Verify database entry
            const dbVerified = await verifyDatabaseEntry(formData);
            if (!dbVerified) {
                console.log('Database verification failed');
                console.log(`Form Fill Test #${testNumber}: FAILED`);
                return { success: false, browser };
            }

            console.log('Form submitted and database entry verified');
            console.log(`Form Fill Test #${testNumber}: PASSED`);
            return { success: true, browser };
        } else {
            console.log(`Form Fill Test #${testNumber}: FAILED`);
            return { success: false, browser };
        }
    } catch (error) {
        console.error('Test execution failed:', error);
        if (browser) {
            return { success: false, browser };
        }
        return { success: false, browser: null };
    }
}

// Run a single test
(async () => {
    let testBrowser;
    try {
        const result = await runTest(1);
        if (!result) {
            console.error('Test failed: No result returned');
            return;
        }
        
        testBrowser = result.browser;
        const success = result.success;
        
        // Print summary
        console.log('\nTest Summary:');
        console.log('-------------');
        console.log(`Form Fill Test #1: ${success ? 'PASSED' : 'FAILED'}`);
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