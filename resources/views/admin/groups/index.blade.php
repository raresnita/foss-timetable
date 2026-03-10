<x-layout>
    <x-heading>Manage users</x-heading>

    <div class="px-8 py-4 bg-slate-50 rounded-xl border border-black/15 dark:bg-slate-900 shadow overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-indigo-600 border-b dark:border-b-indigo-500">
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Name</th>
                    <th colspan="2"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                @foreach ($items as $item)
                    <tr class="hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <td class="py-4 px-4">{{ $item->id }}</td>
                        <td class="py-4 px-4 font-medium">{{ str($item->name)->title() }}</td>

                        <td class="py-4 px-4 text-right w-px whitespace-nowrap">
                            <a href="#"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-500 dark:hover:text-indigo-400 font-semibold">Edit</a>
                        </td>
                        <td class="py-4 px-4 text-right w-px whitespace-nowrap">
                            <button class="text-red-600 hover:text-red-900 font-semibold">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $items->links() }}
    </div>
</x-layout>
