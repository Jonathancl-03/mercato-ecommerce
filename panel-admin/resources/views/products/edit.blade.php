<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-4">
        <a href="{{ route('productos.index') }}" class="inline-flex items-center gap-1 text-sm text-ink-900/50 dark:text-white/40 hover:text-forest-600 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Volver a productos
        </a>

        <h1 class="font-display text-3xl font-semibold mb-8 text-ink-900 dark:text-white">Editar producto</h1>

        @if($errors->any())
            <div class="bg-red-50 text-red-700 px-4 py-3 rounded-xl mb-6 border border-red-200 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('productos.update', $product->id) }}" class="bg-white dark:bg-ink-900 border border-stone-100 dark:border-white/10 rounded-2xl p-6">
            @csrf
            @method('PUT')
            @include('products._form')
            <button type="submit" class="mt-6 bg-forest-600 text-white px-6 py-2.5 rounded-full hover:bg-forest-700 transition-colors font-medium">
                Actualizar producto
            </button>
        </form>
    </div>
</x-app-layout>