<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestão de Estoque
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Produtos cadastrados</h3>
                    <a href="{{ route('produtos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                        + Novo Produto
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">Nome</th>
                            <th class="p-3">Categoria</th>
                            <th class="p-3">Quantidade</th>
                            <th class="p-3">Preço</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produtos as $produto)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $produto->nome }}</td>
                                <td class="p-3">{{ $produto->categoria ?? '-' }}</td>
                                <td class="p-3">{{ $produto->quantidade }}</td>
                                <td class="p-3">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="p-3">
                                    @if ($produto->quantidade <= $produto->estoque_minimo)
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Estoque baixo</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">OK</span>
                                    @endif
                                </td>
                                <td class="p-3 space-x-2">
                                    <a href="{{ route('produtos.edit', $produto) }}" class="text-indigo-600 hover:underline">Editar</a>
                                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-3 text-center text-gray-500">Nenhum produto cadastrado ainda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
