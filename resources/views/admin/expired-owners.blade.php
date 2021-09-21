<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Expired_Owner_Index
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Name</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">email</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">expired_at</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expiredOwners as $expiredOwner)
                                        <tr>
                                            <td class="px-4 py-3">{{ $expiredOwner->name }}</td>
                                            <td class="px-4 py-3">{{ $expiredOwner->email }}</td>
                                            <td class="px-4 py-3">{{ $expiredOwner->deleted_at->diffForHumans() }}</td>
                                            <form method="post" action="{{ route('admin.expired-owners.restore', ['owner' => $expiredOwner->id]) }}" id="restore_{{ $expiredOwner->id }}">
                                                @csrf
                                                <td class="px-4 py-3">
                                                    <a href="#" data-id="{{ $expiredOwner->id }}" onclick="restorePost(this)" class="text-white bg-indigo-500 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded ">Restore</a>
                                                </td>
                                            </form>
                                            <form method="post" action="{{ route('admin.expired-owners.destroy', ['owner' => $expiredOwner->id]) }}" id="delete_{{ $expiredOwner->id }}">
                                                @csrf
                                                <td class="px-4 py-3">
                                                    <a href="#" data-id="{{ $expiredOwner->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded ">ForceDelete</a>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $expiredOwners->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function restorePost(e) {
            'use strict';
            if(confirm('復元しますか?')) {
                document.getElementById('restore_' + e.dataset.id).submit();
            }
        }
        function deletePost(e) {
            'use strict';
            if(confirm('削除しますか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>

