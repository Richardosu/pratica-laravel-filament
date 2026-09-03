<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Produto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('produtos.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nome *</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" class="w-full border-gray-300 rounded" required>
                        @error('nome') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Categoria</label>
                        <input type="text" name="categoria" value="{{ old('categoria') }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descrição</label>
                        <textarea name="descricao" class="w-full border-gray-300 rounded">{{ old('descricao') }}</textarea>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block font-medium mb-1">Quantidade *</label>
                            <input type="number" name="quantidade" value="{{ old('quantidade', 0) }}" class="w-full border-gray-300 rounded" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Preço (R$) *</label>
                            <input type="number" step="0.01" name="preco" value="{{ old('preco', 0) }}" class="w-full border-gray-300 rounded" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Estoque mínimo *</label>
                            <input type="number" name="estoque_minimo" value="{{ old('estoque_minimo', 5) }}" class="w-full border-gray-300 rounded" required>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Salvar</button>
                        <a href="{{ route('produtos.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
