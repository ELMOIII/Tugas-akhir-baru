@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'shadow-sm', 'style' => 'border-color:#dbe5f3;border-radius:14px;min-height:44px;background:rgba(255,255,255,.92);']) }}>
