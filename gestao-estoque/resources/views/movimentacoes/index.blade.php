<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Movimentações de Estoque
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
                    <h3 class="text-lg font-semibold">Histórico de movimentações</h3>
                    <a href="{{ route('movimentacoes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                        + Nova Movimentação
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">Data</th>
                            <th class="p-3">Produto</th>
                            <th class="p-3">Tipo</th>
                            <th class="p-3">Quantidade</th>
                            <th class="p-3">Usuário</th>
                            <th class="p-3">Observação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($movimentacoes as $mov)
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
                                <td class="p-3">{{ $mov->observacao ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-3 text-center text-gray-500">Nenhuma movimentação registrada ainda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
