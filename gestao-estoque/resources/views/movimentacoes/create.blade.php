<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nova Movimentação
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('movimentacoes.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Produto *</label>
                        <select name="produto_id" class="w-full border-gray-300 rounded" required>
                            <option value="">Selecione um produto</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }} (Estoque atual: {{ $produto->quantidade }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tipo *</label>
                        <select name="tipo" class="w-full border-gray-300 rounded" required>
                            <option value="entrada" {{ old('tipo') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                            <option value="saida" {{ old('tipo') == 'saida' ? 'selected' : '' }}>Saída</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Quantidade *</label>
                        <input type="number" name="quantidade" value="{{ old('quantidade', 1) }}" min="1" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Observação</label>
                        <textarea name="observacao" class="w-full border-gray-300 rounded">{{ old('observacao') }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Registrar</button>
                        <a href="{{ route('movimentacoes.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
