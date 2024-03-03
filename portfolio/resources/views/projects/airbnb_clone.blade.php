<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Experience the Magic of Airbnb: Build Your Own Clone!') }}
            </h2>
            <a href="https://github.com/yungryce/airBnB_clone_v2" class=""><i class="fa-brands fa-square-git text-2xl"></i></a>
        </div>
    </x-slot>

    <div class="w-11/12 lg:max-w-4xl container mx-auto bg-white my-4 p-4 md:p-8 rounded shadow-xl shadow-yellow-600">
        <p class="mb-8">Ready to unleash the power of the world's favorite accommodation platform? This project dives into the process development and modeling of an Airbnb clone! exploring different aspects which includes a class based architecture offering modularity and extensibility, database design and modelling with an option for local storage. Data are handled using object relational mapping and a webstatic front end for user interaction.</p>
        <img src="{{ asset('storage/images/hbnb_console1.png') }}" alt="airbnb" class="mx-auto p-12">

        <h2 class="text-2xl font-bold mb-4">Current Features</h2>
        <ul class="list-disc mb-8 list-none space-y-2">
            <li>Unlock the Perfect Stay: Our user-friendly interface lets users filter properties by location, price range, and amenities, ensuring they find their dream accommodation.</li>
            <li>Share Your Story: After their stay, users can share their adventures through feedback, making it easier for fellow travelers to make informed choices.</li>
        </ul>

        <h2 class="text-2xl font-bold mb-4">Technology Stack</h2>
        <p class="mb-8">Python, SQLAlchemy, and MySQLDB join forces to manage the backend and map objects to relational databases ensuring the code remains clean, efficient, and reusable across different classes. We use environment variables to connect to MySQLDB via SQLAlchemy, allowing smooth interactions and data mapping. HTML and CSS make the frontend shine with a sleek, modern design.</p>
        <img src="{{ asset('storage/images/db_model.jpg') }}" alt="airbnb" class="mx-auto p-12">

        <h2 class="text-2xl font-bold mb-4">CLI Developer Helper</h2>
        <p class="mb-8">Our command-line interface (CLI) simplifies property management with intuitive commands like create, show, destroy, and update, making it easy to manage your property portfolio.</p>

        <h2 class="text-2xl font-bold mb-4">Challenges Faced</h2>
        <p class="mb-8">Developing an Airbnb clone presents several challenges, including maintaining proper encapsulation to ensure data integrity and parsing user input to handle unpredictability and security concerns. Robust solutions, such as intelligent command parsing and error handling, demonstrate a commitment to delivering a reliable user experience.</p>

        <h2 class="text-2xl font-bold mb-4">Future Enhancements</h2>
        <ul class="list-disc mb-8">
            <li>Enhanced Backend with Flask: We're exploring ways to enhance functionality and scalability with Flask's robust backend capabilities.</li>
            <li>AI-Powered Recommendations: Imagine a platform that suggests personalized stays based on user preferences and past experiences!</li>
            <li>Tailored to Your World: Customizing the platform for different regions or cultures will make Airbnb feel like a truly global experience.</li>
        </ul>
        <img src="{{ asset('storage/images/hbnb_storage1.png') }}" alt="airbnb_model" class="mx-auto p-12">

        <p class="mb-8">The journey of building an Airbnb clone is filled with excitement and innovation. By overcoming challenges and embracing future enhancements, we're committed to delivering an unparalleled experience for adventurers and property managers around the globe. Welcome to the future of travel!</p>
    </div>
</x-app-layout>
