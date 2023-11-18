
@extends('mail.layouts.layout')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-md rounded px-8 py-6">
            <h2 class="text-2xl font-bold mb-4">Confirm Account Cancellation</h2>
            <p class="mb-4">Are you sure you want to cancel your account?</p>
            <form action="/" method="POST">
                @csrf
                <div class="flex justify-end">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Yes, Cancel Account
                    </button>
                    <a href="/" class="ml-4 text-gray-500 hover:text-gray-600">No, Go Back</a>
                </div>
            </form>
            @{{{body}}}
        </div>
    </div>
@endsection
