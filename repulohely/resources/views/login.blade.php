@extends('include.app')

@section('content')
    <div class="bg-gray-50 dark:bg-black text-black dark:text-white min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="w-full max-w-md px-6 py-8">
            <h2 class="text-xl font-bold mb-6">Bejelentkezés</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">E-mail cím:</label>
                    <input type="email" id="email" name="email" required class="mt-1 p-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Jelszó:</label>
                    <input type="password" id="password" name="password" required class="mt-1 p-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-6 flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm">Emlékezz rám</label>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded text-white focus:outline-none focus:shadow-outline">Bejelentkezés</button>
            </form>
        </div>
    </div>
@endsection
