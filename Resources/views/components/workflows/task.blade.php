@props([
   'param',
   'model'
])

<x-basecore::inputs.group>
    <x-basecore::inputs.text
        name="name"
        label="Nom de la tâche"
        wire:model="{{$model}}.title"
        required="required"
    />
</x-basecore::inputs.group>

<x-basecore::inputs.group>
    <x-basecore::inputs.number
        name="name"
        label="Déclencher dans combien de temps ?"
        wire:model="{{$model}}.hours"
        required="required"
    />
</x-basecore::inputs.group>
