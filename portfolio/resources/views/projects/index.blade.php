<x-app-layout>

    <div class="flex flex-wrap mb-6 lg:space-x-12 lg:justify-center">
        <x-project-cards title="Simple shell" image="{{ asset('storage/images/sh-shell.gif') }}" alt="shell" link="{{ route('projects.show', 'simple_shell') }}" github="https://github.com/yungryce/simple_shell"/>
        <x-project-cards title="PHP Authentication System" image="{{ asset('storage/images/auth.jpg') }}" alt="auth" link="{{ route('projects.show', 'vanilla_auth') }}" github="http://github.com/yungryce/php_auth"/>
        <x-project-cards title="AirBnB Clone" image="{{ asset('storage/images/hbnb_clone.gif') }}" alt="AiBnB Clone" link="{{ route('projects.show', 'airbnb_clone') }}" github="https://github.com/yungryce/AirBnB_clone"/>
        <x-project-cards title="EasyPay Services" image="{{ asset('storage/images/php_app.png') }}" alt="easyPay" link="{{ route('projects.show', 'easypay') }}" github="http://github.com/yungryce/php_app"/>
        <x-project-cards title="EasyPay Services" image="{{ asset('storage/images/php_app.png') }}" alt="easyPay" link="/blog/easyPay.php" github="http://github.com/yungryce/php_app"/>
    </div>

</x-app-layout>

