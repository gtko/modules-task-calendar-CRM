<x-corecrm::timeline-item>
    <x-slot name="image">
        @if(($flow->datas->getTask()->data['type'] ?? '') === 'appel')
            <svg class='h-7 w-7' fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M377.7 296.3l-54.22-23.23c-9.594-4.141-21.05-1.406-27.61 6.766l-17.92 21.89C249.4 286.3 225.7 262.6 210.4 234.1l21.89-17.94c8.094-6.625 10.89-17.94 6.797-27.58L215.8 134.3C211.2 123.8 199.8 118.1 188.7 120.6L138.3 132.2C127.5 134.7 120 144.2 120 155.3C120 285.8 226.2 392 356.8 392c11.08 0 20.55-7.531 23.03-18.31l11.62-50.39C393.1 312.2 388.2 300.8 377.7 296.3zM364.2 370.1C363.4 373.6 360.3 376 356.8 376C235 376 136 276.1 136 155.3c0-3.578 2.422-6.625 5.906-7.422l50.39-11.62C192.9 136.1 193.4 136 194 136c3 0 5.812 1.781 7.047 4.625l23.27 54.25c1.312 3.109 .4062 6.766-2.219 8.906L190.3 229.8l2.781 5.703c17.7 36.06 47.33 65.67 83.42 83.41l5.703 2.797l26.08-31.88c2.094-2.609 5.75-3.531 8.859-2.141l54.22 23.23c3.406 1.469 5.266 5.141 4.438 8.734L364.2 370.1zM256 0c-141.4 0-256 114.6-256 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM256 496c-132.3 0-240-107.7-240-240S123.7 16 256 16s240 107.7 240 240S388.3 496 256 496z"/></svg>
        @else
            <svg class='h-5 w-5' fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M152.1 38.16C161.9 47.03 162.7 62.2 153.8 72.06L81.84 152.1C77.43 156.9 71.21 159.8 64.63 159.1C58.05 160.2 51.69 157.6 47.03 152.1L7.029 112.1C-2.343 103.6-2.343 88.4 7.029 79.03C16.4 69.66 31.6 69.66 40.97 79.03L63.08 101.1L118.2 39.94C127 30.09 142.2 29.29 152.1 38.16V38.16zM152.1 198.2C161.9 207 162.7 222.2 153.8 232.1L81.84 312.1C77.43 316.9 71.21 319.8 64.63 319.1C58.05 320.2 51.69 317.6 47.03 312.1L7.029 272.1C-2.343 263.6-2.343 248.4 7.029 239C16.4 229.7 31.6 229.7 40.97 239L63.08 261.1L118.2 199.9C127 190.1 142.2 189.3 152.1 198.2V198.2zM224 96C224 78.33 238.3 64 256 64H480C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H256C238.3 128 224 113.7 224 96V96zM224 256C224 238.3 238.3 224 256 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H256C238.3 288 224 273.7 224 256zM160 416C160 398.3 174.3 384 192 384H480C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H192C174.3 448 160 433.7 160 416zM0 416C0 389.5 21.49 368 48 368C74.51 368 96 389.5 96 416C96 442.5 74.51 464 48 464C21.49 464 0 442.5 0 416z"/></svg>
        @endif
    </x-slot>
    <div class="flex items-center">
        <div class="font-medium flex flex-col">
            <div>
           @if(($flow->datas->getTask()->data['type'] ?? 'normal') === 'normal')
                Création d'une tache {{($flow->datas->getTask()->data['important'] ?? false) ? 'importante' : ''}}
                <span>
                    @if(!$flow->datas->getTask()->checked)
                        <span>a faire le {{$flow->datas->getTask()->start->format('d/m/Y H:i:s')}}</span>
                    @else
                        <span class="text-green-600">Fait le {{$flow->datas->getTask()->updated_at->format('d/m/Y H:i:s')}}</span>
                    @endif
                    <div class="text-gray-600 p-2">
                        {{$flow->datas->getTask()->content}}
                    </div>
                </span>
           @endif

           @if(($flow->datas->getTask()->data['type'] ?? '') === 'appel')
               <span>
                   Appel {{($flow->datas->getTask()->data['important'] ?? false) ? 'important' : ''}}

                   @if(($flow->datas->getTask()->data['appel'] ?? null) === null)
                       <span class="text-blue-600">à faire</span> {{$flow->datas->getTask()->start->format('d/m/Y H:i:s')}}
                   @endif

                   @if(($flow->datas->getTask()->data['appel'] ?? null) === true)
                       <span class="text-green-600">joint</span> le {{$flow->datas->getTask()->updated_at->format('d/m/Y H:i:s')}}
                   @endif

                   @if(($flow->datas->getTask()->data['appel'] ?? null) === false)
                       <span class="text-red-600">non-joint</span> le {{$flow->datas->getTask()->updated_at->format('d/m/Y H:i:s')}}
                   @endif
               </span>
           @endif
            </div>
            @if($flow->datas->getTask()->data['role_name'] ?? false)
                <div class="rounded px-2 mt-2 py-1 bg-blue-600 text-white">Tache de role : {{$flow->datas->getTask()->data['role_name']}}</div>
            @endif
        </div>

        <div class="text-xs text-gray-500 ml-auto">{{$flow->created_at->format('H:i')}}</div>
    </div>
</x-corecrm::timeline-item>
