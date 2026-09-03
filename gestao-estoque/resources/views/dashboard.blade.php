<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total de produtos</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalProdutos }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Produtos com estoque baixo</p>
                    <p class="text-3xl font-bold {{ $estoqueBaixo > 0 ? 'text-red-600' : 'text-gray-800' }}">{{ $estoqueBaixo }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Valor total em estoque</p>
                    <p class="text-3xl font-bold text-gray-800">R$ {{ number_format($valorTotalEstoque, 2, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Últimas movimentações</h3>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">Data</th>
                            <th class="p-3">Produto</th>
                            <th class="p-3">Tipo</th>
                            <th class="p-3">Quantidade</th>
                            <th class="p-3">Usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ultimasMovimentacoes as $mov)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3">{{ $mov->produto->nome }}</td>
                                <td class="p-3">
                                    @if ($mov->tipo === 'entrada')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Entrada</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Saída</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $mov->quantidade }}</td>
                                <td class="p-3">{{ $mov->user->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">Nenhuma movimentação registrada ainda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
