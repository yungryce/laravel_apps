<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Building a Secure Authentication System with Vanilla PHP, JavaScript, and Tailwind CSS') }}
            </h2>
            <a href="https://github.com/yungryce/php_auth" class=""><i class="fa-brands fa-square-git text-2xl"></i></a>
        </div>
    </x-slot>

    <div class="w-11/12 lg:max-w-4xl container mx-auto bg-white my-12 p-4 md:p-8 rounded shadow-xl shadow-yellow-600">

        <h1 class="text-2xl md:text-3xl mx-auto font-bold mb-6 text-center">Building a Secure Authentication System with Vanilla PHP, JavaScript, and Tailwind CSS</h1>
        <p class="mb-4">In the dynamic realm of web development, constructing a secure and efficient authentication system is pivotal for user-centric applications. Join me on a journey as I share my experience in implementing a robust authentication system using Vanilla PHP, JavaScript, and Tailwind CSS. This system incorporates server-side validations, user session handling, SQL prepared statements, repopulated fields on errors, and a "forgot password" feature. Along the way, I'll delve into the challenges faced and outline future updates in the pipeline.</p>

        <h1 class="text-xl md:text-2xl mx-auto font-bold mb-6 text-center">Key Implementations</h1>

        <h2 class="text-xl font-bold mb-2">Server-side Validations</h2>
        <p class="mb-8">Thorough validations on the server side ensure the integrity of user data, checking length, format, and uniqueness of names, emails, and phone numbers. Passwords are securely hashed using PHP before storage in the database.</p>

        <h2 class="text-xl font-bold mb-2">User Session Handling</h2>
        <p class="mb-8">Efficient user session handling is crucial for a seamless experience. Secure techniques are employed to manage user sessions, keeping track of logged-in users and storing essential information in session variables. The session status is checked on each page, redirecting users to the login page if not logged in.</p>

        <h2 class="text-xl font-bold mb-2">SQL Prepared Statements</h2>
        <p class="mb-8">To guard against SQL injection attacks, all database interactions use prepared statements. This ensures user input is treated as data, not executable code, enhancing system security.</p>

        <h2 class="text-xl font-bold mb-2">Repopulated Fields on Errors</h2>
        <p class="mb-8">In case of form submission errors, fields are repopulated with user input. This user-friendly feature eliminates the need for users to re-enter information, providing a smoother experience.</p>

        <h2 class="text-xl font-bold mb-2">Forgot Password</h2>
        <p class="mb-8">Implementing a "forgot password" feature allows users to reset their passwords securely. This process involves email verification and provides an additional layer of security.</p>

        <h2 class="text-xl md:text-2xl mx-auto font-bold text-center">Setup Steps</h2>
        <ul class="list-disc pl-6 py-2">
            <li class="">Validate first and last names, ensuring standard C locale letters within 3 to 20 characters.</li>
            <li class="">Validate email as a standard format and check its uniqueness in the database.</li>
            <li class="">Validate the password format, requiring at least one uppercase, lowercase, number, and special character.</li>
            <li class="">Validate phone number format and check its uniqueness in the database.</li>
            <li class="">Establish a database connection using mysqli, keeping sensitive details in a separate config file.</li>
        </ul>
        <p class="mb-8">If there are no errors, user’s data is inserted into the database, an activation code is generated, and an email is sent to the user with the activation link, and the user is redirected to the verification page.</p>

        <h2 class="text-2xl font-bold mb-2">Challenges Faced</h2>
        <p class="mb-8">A significant challenge encountered was implementing email verification and password reset features. This required understanding not only web servers but also email servers. Working with PHPMailer and configuring it with Gmail, generating unique and secure codes, and setting expiration times for links were crucial aspects. Ensuring links were tamper-proof and not reusable by malicious users added an extra layer of complexity.</p>

        <h2 class="text-xl md:text-2xl font-bold mb-2">Future Updates</h2>
        <p class="">Anticipated updates to the authentication system include:</p>
        <ul class="list-disc pl-6 mb-8">
                <li class="">Adding a profile page for users to view and edit their details.</li>
                <li class="">Introducing a "remember me" option to keep users logged in for an extended period.</li>
                <li class="">Implementing captcha or reCAPTCHA to prevent bots and spam.</li>
                <li class="">Introducing social login options (e.g., Facebook, Google) for user convenience.</li>
                <li class="">Adding two-factor authentication for enhanced account security.</li>
                <li class="">Implementing different authentication levels for diverse user roles.</li>
        </ul>

        <h2 class="text-2xl font-bold mb-2">Conclusion</h2>
        <p class="mb-8">Constructing a robust authentication system demands a comprehensive understanding of security practices, server configurations, and user experience considerations. This blog post aims to inspire developers to prioritize security and user convenience in their authentication systems. Stay tuned for future updates as we continue to enhance and expand the capabilities of our authentication system.</p>
    </div>
</x-app-layout>