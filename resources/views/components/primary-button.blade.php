<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent font-semibold text-xs text-white uppercase tracking-widest focus:outline-none transition ease-in-out duration-150', 'style' => 'border-radius:14px;background:linear-gradient(135deg,#ec7fad,#6aa9df);box-shadow:0 14px 26px rgba(106,169,223,.26);']) }}>
    {{ $slot }}
</button>
