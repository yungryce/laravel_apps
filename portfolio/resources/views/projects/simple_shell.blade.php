<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Simple Shell') }}
            </h2>
            <a href="https://github.com/yungryce/simple_shell" class=""><i class="fa-brands fa-square-git text-2xl"></i></a>
        </div>
    </x-slot>

    <div class="w-11/12 lg:max-w-4xl container mx-auto bg-white my-4 p-4 md:p-8 rounded shadow-xl shadow-yellow-600">
        <p class="mb-4">
            In the realm of command-line interfaces (CLI), the implementation of a simple shell is a fundamental yet powerful venture. This article takes a comprehensive look at the intricacies of a custom shell implemented using C. The code snippet provided is a practical demonstration of a minimalistic shell, complete with features such as prompt display, command execution, built-in functionality, and error handling.
        </p>

        <pre class="bg-cyan-100 max-w-2xl mx-auto p-2 mb-4 font-bold overflow-x-auto">
            <code class="language-c5">
     ____       _                     __    ____  _          _ _ 
   / ____|     | |                   / _|  / ____| |        | | |
  | |  __  __ _| |_ ___   __    ___ | |_  | (___ | |__   ___| | |
  | | |_ |/ _` | __/ _ \/ __|  / _ \|  _|  \___ \| '_ \ / _ \ | |
  | |__| | (_| | ||  __/\__ \ | (_) | |    ____) | | | |  __/ | |
   \_____|\__,_|\__\___||___/  \___/|_|   |_____/|_| |_|\___|_|_|

           printf("Welcome to the Simple Shell!\n");
            </code>
        </pre>

        <h2 class="text-2xl font-bold mb-4">Installation and Usage</h2>
        <p class="mb-8">For detailed instructions on downloading, compiling, and using the simple shell, refer to the <a href="{{ route('projects.simple_shell_setup') }}" class="text-blue-700 hover:underline font-bold">Testing and Usage</a>.</p>

        <h2 class="text-2xl font-bold mb-4">Prompt and User Interaction</h2>
        <p class="mb-4">The shell begins by displaying a user-friendly prompt and patiently waiting for user input. This is achieved through the <code class="bg-gray-200 p-1">readline</code> function, which reads input from the standard input (stdin) and handles user interactions. The prompt is redisplayed after each command execution or when the Enter key is pressed.</p>

        <div class="relative max-w-2xl mx-auto bg-cyan-100 p-2 mb-12 italic font-bold">
            <pre class="relative overflow-x-auto"><code id="language-c">
int readline(CommandInfo *cmd_info);
            </code></pre>

            <button onclick="copyToClipboard('language-c')" class="absolute top-0 right-0 mt-2 mr-2 bg-blue-900 text-white px-3 py-1 opacity-50 hover:opacity-100 rounded-md">
                <i class="fas fa-copy"></i>
            </button>

        </div>


        <h2 class="text-2xl font-bold mb-4">Tokenization Process</h2>
        <p class="mb-4">The user's input is then tokenized, a crucial step in breaking down the command into individual words or tokens. The <code class="bg-gray-200 p-1">tokenizer</code> function employs the <code class="bg-gray-200 p-1">strtok</code> function to split the input string into manageable components, allowing for easy interpretation and processing.</p>

        <div class="relative max-w-2xl mx-auto bg-cyan-100 p-2 mb-12 italic font-bold">
            <pre class="relative overflow-x-auto"><code id="language-c1">
int tokenizer(CommandInfo *cmd_info);
            </code></pre>

            <button onclick="copyToClipboard('language-c1')" class="absolute top-0 right-0 mt-2 mr-2 bg-blue-900 text-white px-3 py-1 opacity-50 hover:opacity-100 rounded-md">
                <i class="fas fa-copy"></i>
            </button>
        </div>

        <h2 class="text-2xl font-bold mb-4">Parsing and Execution</h2>
        <p class="mb-4">Once the input is tokenized, the shell must decide whether the command is a built-in function or an external command. The <code class="bg-gray-200 p-1">parser</code> function handles this by distinguishing between absolute paths, relative paths, and commands starting with "./". The execution is carried out through the <code class="bg-gray-200 p-1">execute</code> function, utilizing the <code class="bg-gray-200 p-1">fork</code> and <code class="bg-gray-200 p-1">execve</code> system calls.</p>

        <div class="relative max-w-2xl mx-auto bg-cyan-100 p-2 mb-12 italic font-bold">
            <pre class="relative overflow-x-auto"><code id="language-c2">
int parser(CommandInfo *cmd_info);
int execute(CommandInfo *cmd_info);
            </code></pre>

            <button onclick="copyToClipboard('language-c2')" class="absolute top-0 right-0 mt-2 mr-2 bg-blue-900 text-white px-3 py-1 opacity-50 hover:opacity-100 rounded-md">
                <i class="fas fa-copy"></i>
            </button>
        </div>

        <h2 class="text-2xl font-bold mb-4">Built-in Functions</h2>
        <p class="mb-4">The shell provides support for essential built-in functions, including <code class="bg-gray-200 p-1">cd</code>, <code class="bg-gray-200 p-1">env</code>, <code class="bg-gray-200 p-1">setenv</code>, <code class="bg-gray-200 p-1">unsetenv</code>, <code class="bg-gray-200 p-1">exit</code>, and <code class="bg-gray-200 p-1">help</code>. Each built-in function is implemented as a separate module, enhancing the modularity and maintainability of the code.</p>

        <div class="relative max-w-2xl mx-auto bg-cyan-100 p-2 mb-12 italic font-bold">
            <pre class="relative overflow-x-auto"><code id="language-c3">
int (*get_builtin(char *command))(CommandInfo *);
int set_data(CommandInfo *cmd_info);
int run_args(CommandInfo *cmd_info); 
            </code></pre>

            <button onclick="copyToClipboard('language-c3')" class="absolute top-0 right-0 mt-2 mr-2 bg-blue-900 text-white px-3 py-1 opacity-50 hover:opacity-100 rounded-md">
                <i class="fas fa-copy"></i>
            </button>
        </div>

        <h2 class="text-2xl font-bold mb-4 mt-8">Error Handling</h2>
        <p class="mb-4">Robust error handling is a hallmark of a well-designed shell. The implementation addresses various scenarios, such as invalid commands, permission issues, and memory allocation errors. The shell diligently reports errors to the user, ensuring a smooth and transparent user experience.</p>

        <div class="relative max-w-2xl mx-auto bg-cyan-100 p-2 mb-12 italic font-bold">
            <pre class="relative overflow-x-auto"><code id="language-c4">
void handle_SIGINT(int sig);
int get_error(CommandInfo *cmd_info, int ret);
            </code></pre>

            <button onclick="copyToClipboard('language-c4')" class="absolute top-0 right-0 mt-2 mr-2 bg-blue-900 text-white px-3 py-1 opacity-50 hover:opacity-100 rounded-md">
                <i class="fas fa-copy"></i>
            </button>
        </div>

        <p class="">In conclusion, the implementation of a simple shell involves a carefully orchestrated interplay of prompt display, user interaction, tokenization, parsing, execution, and error handling. This article provides a detailed walkthrough of each aspect, shedding light on the inner workings of a compact yet functional shell implemented in the C programming language.</p>

    </div>


</x-app-layout>
