@extends('layout')

@section('content')

<div>

    <div class="flex items-center justify-between mb-10">

        <div>

            <h1 class="page-title">
                Applications
            </h1>

            <p class="page-subtitle">
                Review scholarship applications.
            </p>

        </div>

    </div>

    <!-- FILTERS -->

    <div class="card p-6 mb-8">

        <form method="GET"
              class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search student..."
                   class="input">

            <select name="status"
                    class="input">

                <option value="">
                    All Status
                </option>

                <option value="pending">
                    Pending
                </option>

                <option value="approved">
                    Approved
                </option>

                <option value="rejected">
                    Rejected
                </option>

            </select>

            <button class="btn-primary">
                Search
            </button>

        </form>

    </div>

    <!-- TABLE -->

    <div class="card overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-50 border-b border-borderc">

                <tr>

                    <th class="p-5 text-left">
                        Student
                    </th>

                    <th class="p-5 text-left">
                        Scholarship
                    </th>

                    <th class="p-5 text-left">
                        Status
                    </th>

                    <th class="p-5 text-left">
                        Documents
                    </th>

                    <th class="p-5 text-left">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($applications as $application)

                    <tr class="border-b border-borderc">

                        <td class="p-5">
                            {{ $application->user->name }}
                        </td>

                        <td class="p-5">
                            {{ $application->scholarship->title }}
                        </td>

                        <td class="p-5">

                            <span class="
                                px-3 py-1 rounded-full text-sm

                                @if($application->status === 'approved')
                                    bg-green-100 text-green-700
                                @elseif($application->status === 'rejected')
                                    bg-red-100 text-red-700
                                @else
                                    bg-yellow-100 text-yellow-700
                                @endif
                            ">

                                {{ ucfirst($application->status) }}

                            </span>

                        </td>

                        <td class="p-5">

                            <div class="flex flex-col gap-2">

                                @foreach($application->documents as $document)

                                    <a href="{{ asset('storage/'.$document->file_path) }}"
                                       target="_blank"
                                       class="text-primary hover:underline">

                                        {{ $document->document_name }}

                                    </a>

                                @endforeach

                            </div>

                        </td>

                        <td class="p-5">

                            <div class="flex gap-3">

                                @if($application->status === 'pending')

                                    <form method="POST"
                                          action="{{ route('admin.applications.approve', $application) }}">

                                        @csrf

                                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">
                                            Approve
                                        </button>

                                    </form>

                                    <form method="POST"
                                          action="{{ route('admin.applications.reject', $application) }}">

                                        @csrf

                                        <input type="hidden"
                                               name="remark"
                                               value="Application rejected by admin">

                                        <button class="btn-danger">
                                            Reject
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->

    <div class="mt-8">

        {{ $applications->links() }}

    </div>

</div>

@endsection