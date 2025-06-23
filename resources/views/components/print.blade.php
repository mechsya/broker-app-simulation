  <div class="flex flex-col lg:flex-row justify-between lg:mb-0 mb-4">
      <div class="flex gap-2 items-center mb-4">
          <button class="bg-blue-500 px-4 py-1 rounded" onclick="exportData('{{ $model }}', 'excel', event)"
              data-csrf="{{ csrf_token() }}">Excel</button>
          <button class="bg-blue-500 px-4 py-1 rounded" onclick="exportData('{{ $model }}', 'csv', event)"
              data-csrf="{{ csrf_token() }}">CSV</button>
          <button class="bg-blue-500 px-4 py-1 rounded" onclick="exportData('{{ $model }}', 'pdf', event)"
              data-csrf="{{ csrf_token() }}">PDF</button>
      </div>
  </div>
