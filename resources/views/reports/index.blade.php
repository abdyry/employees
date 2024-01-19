<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Column 1: Select Report -->
        <div>
            <label for="report" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Report</label>
            <select id="report"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-full">
                <option value="0">Select an Option</option>
                @foreach($reports as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <!-- Column 2: Report Parameters -->
        <div id="params">
            <!-- Report parameters will be loaded here via AJAX -->
        </div>
    </div>

    <button type="button" id="generateReport" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Generate Report</button>
    <div id="reportContent" class="mt-4">
        <!-- The content of the generated report will be loaded here -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#report').on('change', function () {
                var selectedReport = $(this).val();
                $.ajax({
                    url: '{{ route("report.params", ["type" => "_selectedReport_"]) }}'.replace('_selectedReport_', selectedReport),
                    type: 'GET',
                    dataType: 'html',
                    success: function (response) {
                        $('#params').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX request error:', xhr.responseText);
                    }
                });
            });

            $('#generateReport').on('click', function () {
                // Extract values from input fields
                var employeeName = $('#employeeName').val();
                var selectedReport = $('#report').val();

                // Log the values to the console
                console.log('Report Type:', selectedReport);
                console.log('Employee Name:', employeeName);

                // Include CSRF token in headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("generate.report") }}',
                    type: 'POST',
                    data: {
                        // reportType: selectedReport,
                        // customerName: employeeName,
                    },
                    dataType: 'html',
                    success: function (response) {
                                        // Open a popup window with the report content
                        var newWindow = window.open('', '_blank', 'width=600,height=400');
                        newWindow.document.write(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX request error:', xhr.responseText);
                    }
                });


            });
        });
    </script>
</x-app-layout>
