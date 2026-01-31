@props(['code', 'language' => 'php'])

<div class="code-container relative group">
    <div class="absolute right-4 top-4 opacity-0 group-hover:opacity-100 transition-opacity">
        <button onclick="navigator.clipboard.writeText(`{{ $code }}`)" class="p-2 bg-white/10 rounded-md text-white/70 hover:text-white hover:bg-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </button>
    </div>
    <pre class="whitespace-pre-wrap"><code class="language-{{ $language }}">{{ $code }}</code></pre>
</div>
