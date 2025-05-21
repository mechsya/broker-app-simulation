  <div x-data="{ open: false }">
      <div class="w-full flex justify-between items-center border-b border-white/25 p-4 bg-black"
          x-on:click="open = !open">
          <p>{{ $label }}</p>
          <p x-html="open ? '-' : '+'"></p>
      </div>
      <div class="max-h-0 overflow-hidden duration-300" x-ref="container"
          x-bind:style="open ? 'max-height: ' + $refs.container.scrollHeight + 'px;' : ''">
          <div class="p-4">
              <p class="bg-white text-blue-900 p-2">
                  {!! $description !!}
              </p>
          </div>
      </div>
  </div>
