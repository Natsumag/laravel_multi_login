<x-tests.app>
    <x-slot name="header">ヘッダー１</x-slot>
    コンポーネントテスト１
    <x-tests.card title="タイトル" content="コンテンツ" :message="$message" />
    <x-tests.card title="タイトル" />
    <x-tests.card title="CSS変更" class="bg-red-300" />
</x-tests.app>
