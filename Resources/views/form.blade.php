@php $editing = isset($task) @endphp

<x-basecore::inputs.group>
    <x-basecore::inputs.basic name="title" label="Titre" value="{!!  old('title', ($editing ? $task->title : '')) !!}" required/>
</x-basecore::inputs.group>
<x-basecore::inputs.group>
    <x-basecore::inputs.basic name="url" label="Lien" value="{{ old('url', ($editing ? $task->url : '')) }}"/>
</x-basecore::inputs.group>
<x-basecore::inputs.group>
    <x-basecore::inputs.datetime name="start" label="Date de début" value="{{ old('start', ($editing ? $task->start->format('Y-m-d\TH:i') : '')) }}"/>
</x-basecore::inputs.group>
<x-basecore::inputs.group>
    <x-basecore::inputs.datetime name="end" label="Date de fin" value="{{ old('end', ($editing && $task->end ? $task->end?->format('Y-m-d\TH:i') : '')) }}"/>
</x-basecore::inputs.group>
<x-basecore::inputs.group>
    <x-basecore::inputs.textarea name="description" label="Description">{!! old('description', ($editing ? $task->content : '')) !!}</x-basecore::inputs.textarea>
</x-basecore::inputs.group>
