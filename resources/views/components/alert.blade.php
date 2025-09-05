<style>
    [x-cloak] { display: none !important; }
  </style>
  
  <div 
      id="alert"
      tabindex="-1"
      x-data="{ show: false, message: '', type: '' }" 
      x-show="show" 
      x-transition 
      x-cloak
      x-init="window.addEventListener('show-alert', event => {
          message = event.detail.message;
          type = event.detail.type;
          show = true;
          $nextTick(() => {
              $el.focus();
          });
          setTimeout(() => show = false, 3000);
      })"
      :class="{
          'bg-green-500': type === 'success',
          'bg-red-500': type === 'danger',
          'bg-yellow-500 text-black': type === 'warning',
          'bg-blue-500': type === 'info',
          'bg-gray-500': !['success', 'danger', 'warning', 'info'].includes(type)
      }"
      class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 rounded-lg p-2 font-semibold text-white max-w-md w-full text-center shadow-lg"
  >
      <span x-text="message"></span>
  </div>


  

