<section class="max-w-screen-lg mx-auto p-4">
    <div class="border border-gray-300 shadow-sm rounded-lg">
        <header class="border-b border-gray-300 p-2">
            <label class="space-x-1 flex justify-between items-center">
                <span class="font-bold">Items Table</span>
                <select wire:model.live="perPage"
                    class="ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 p-2 text-xs rounded-md">
                    @foreach ($options as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </label>
        </header>

        <table class="w-full">
            <thead class="bg-gray-100 sticky top-0 border-b border-gray-300">
                <tr class="text-left">
                    <th class="px-3 py-2">
                        <div class="flex items-center justify-between gap-2">
                            <div class="font-medium">Name</div>
                            <div class="flex gap-1">
                                <label title="Descending" class="cursor-pointer ring-1 ring-gray-300 rounded-md py-1.5 px-1 hover:opacity-80 @if ($sortDirection === 'desc') bg-blue-500 text-gray-50 @endif">
                                    <input class="hidden" wire:model.live="sortDirection" type="radio"
                                        value="desc" />
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                                    </svg>
                                </label>
                                <label title="Ascending" class="cursor-pointer ring-1 ring-gray-300 rounded-md py-1.5 px-1 hover:opacity-80 @if ($sortDirection === 'asc') bg-blue-500 text-gray-50 @endif">
                                    <input class="hidden" wire:model.live="sortDirection" type="radio"
                                        value="asc" />
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th class="px-3 pb-2">
                        <input wire:model.live.debounce.200ms="search"
                            class="font-normal ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 p-2 text-base rounded-md w-full"
                            type="text" placeholder="Search Items..." />
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @if (count($items) > 0)
                    @foreach ($items as $item)
                        <tr wire:key="item-{{ $item->id }}" class="even:bg-gray-50">
                            <td class="p-3">{{ $item->name }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <div class="min-h-56 flex items-center justify-center p-2">
                                <p>Item you are searching doesn't exists.</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
            @if ($items->hasPages())
                <tfoot class="sticky bottom-0">
                    <tr>
                        <td>
                            <footer class="pagination p-2 border-t rounded-lg rounded-t-none bg-white border-gray-300">
                                {{ $items->links() }}
                            </footer>
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</section>
