<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <div class="flex justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        
        <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-2">Verify Your Email</h1>
        
        <div class="mb-6 text-sm text-gray-600 dark:text-gray-400 text-center">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <div id="status-message" class="hidden mb-4 p-3 rounded-md text-sm bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200">
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form class="w-full sm:w-auto">
                <button type="button" id="resend-button" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors">
                    Resend Verification Email
                </button>
            </form>

            <form class="w-full sm:w-auto">
                <button type="button" class="w-full text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 underline px-4 py-2">
                    Log Out
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resendButton = document.getElementById('resend-button');
            const statusMessage = document.getElementById('status-message');
            
            // Simulate resend verification email
            resendButton.addEventListener('click', function() {
                // Show status message
                statusMessage.classList.remove('hidden');
                
                // Hide status message after 5 seconds
                setTimeout(function() {
                    statusMessage.classList.add('hidden');
                }, 5000);
                
                // Simulate API call
                this.textContent = 'Sending...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.textContent = 'Resend Verification Email';
                    this.disabled = false;
                }, 1500);
            });
        });
    </script>
</body>
</html>