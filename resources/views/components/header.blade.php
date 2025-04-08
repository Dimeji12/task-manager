<!-- Header Component -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600 py-4 text-center flex flex-row items-center justify-center space-x-4 sm:ml-64">
    <img src="{{ asset('images/chrysalis.png') }}" alt="Logo" class="w-12 h-12">
    <div class="text-left">
        <h1 class="text-2xl sm:text-4xl font-bold text-white animate-bounce">
            Welcome, {{ Auth::user()->name }}!
        </h1>
        <p class="mt-1 text-sm sm:text-lg text-white opacity-90">
            We're glad to have you here. Let's get things done!
        </p>
    </div>
</div>