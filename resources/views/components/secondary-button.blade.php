<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 border font-semibold text-xs uppercase tracking-widest focus:outline-none disabled:opacity-25 transition ease-in-out duration-150', 'style' => 'border-radius:14px;color:#45607e;background:#eef7ff;border-color:#d7e9fb;']) }}>
    {{ $slot }}
</button>
