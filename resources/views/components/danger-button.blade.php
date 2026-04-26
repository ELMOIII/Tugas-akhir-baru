<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150', 'style' => 'border-radius:14px;color:#a43661;background:#ffe5ef;border-color:#ffc5da;']) }}>
    {{ $slot }}
</button>
