<div id="detailTotalItemsPopup" class="fixed inset-0 hidden z-50 overflow-auto bg-gray-900 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white w-11/12 md:w-2/5 border-2 p-4 font-times">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse text-center">
                <thead>
                    <tr class="bg-primary text-primary-foreground text-md">
                        <th class="py-2 px-2 border border-white">Item Name</th>
                        <th class="py-2 px-2 border border-white">Category</th>
                        <th class="py-2 px-2 border border-white">UOM</th>
                        <th class="py-2 px-2 border border-white">Expired Date</th>
                    </tr>
                </thead>
                <tbody id="inventoryTableBody">
                    @foreach($inventory as $data)
                    <tr class="bg-zinc-200 text-base border-t-4 border-white">
                      <td class="py-3 px-4 border border-white">{{$data->Item_Name}}</td>
                      <td class="py-3 px-4 border border-white">{{$data->Category}}</td>
                      <td class="py-3 px-4 border border-white">{{$data->UOM}}</td>
                      <td class="py-3 px-4 border border-white">{{$data->Expired_Date}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
