@extends('layouts.guest')

@section('content')
    <x-ui::card title="{{ trans('terms.publicPage.title') }}">
        <div class="space-y-4 text-sm text-gray-700 dark:text-gray-300">
            <p>{{ trans('terms.publicPage.term1') }}</p>
            <p>{{ trans('terms.publicPage.term2') }}</p>
            <p>{{ trans('terms.publicPage.term3') }}</p>
            <p>{{ trans('terms.publicPage.term4') }}</p>
            <p>{{ trans('terms.publicPage.term5') }}</p>
            <p>{{ trans('terms.publicPage.term6') }}</p>
            <p>{{ trans('terms.publicPage.term7') }}</p>
            <p>{{ trans('terms.publicPage.term8') }}</p>
        </div>

        <div class="mt-6 text-center text-sm">
            <a href="{{ url('/') }}" class="text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-900 dark:hover:text-gray-100">
                Back to home
            </a>
        </div>
    </x-ui::card>
@endsection
