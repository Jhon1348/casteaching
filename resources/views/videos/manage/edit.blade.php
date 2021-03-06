<x-casteaching-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$video->title}}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-10">
        <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">

        @can('videos_manage_create')

                <x-jet-form-section data-qa="form_video_edit">
                    <x-slot name="title">
                        {{ __('Vídeos') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Informació bàsica del vídeo') }}
                    </x-slot>

                    <x-slot name="actions">
                        <x-jet-button>
                            {{ __('Modificar') }}
                        </x-jet-button>
                    </x-slot>

                    <x-slot name="form">
                        @csrf
                        @method('PUT')
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="title" value="{{ __('Title') }}" />
                            <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="name" required value="{{$video->title}}"/>
                            <x-jet-input-error for="title" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea required id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Description">{{$video->description}}</textarea>
                            <x-jet-input-error for="description" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="url" value="{{ __('URL') }}" />
                            <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    http://
                                    </span>
                                <input required type="url" name="url" id="url" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block  rounded-none rounded-r-md sm:text-sm border-gray-300" value="{{$video->url}}">
                            </div>
                            <x-jet-input-error for="url" class="mt-2" />
                        </div>
                    </x-slot>
                </x-jet-form-section>
{{--                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">--}}
{{--                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">--}}
{{--                    <div class="p-4">--}}
{{--                        <div class="md:grid md:grid-cols-3 md:gap-6">--}}
{{--                            <div class="md:col-span-1">--}}
{{--                                <div class="px-4 sm:px-0">--}}
{{--                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Vídeos</h3>--}}
{{--                                    <p class="mt-1 text-sm text-gray-600">--}}
{{--                                        Informació bàsica del vídeo--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="mt-5 md:mt-0 md:col-span-2">--}}
{{--                                <form data-qa="form_video_edit" action="#" method="POST" >--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <div class="shadow sm:rounded-md sm:overflow-hidden">--}}
{{--                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">--}}

{{--                                            <div>--}}
{{--                                                <label for="title" class="block text-sm font-medium text-gray-700">--}}
{{--                                                    Title--}}
{{--                                                </label>--}}
{{--                                                <div class="mt-1">--}}
{{--                                                    <input required id="title" name="title" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2"  value="{{$video->title}}"></input>--}}
{{--                                                </div>--}}
{{--                                                <p class="mt-2 text-sm text-gray-500">--}}
{{--                                                    Titol curt del vídeo--}}
{{--                                                </p>--}}
{{--                                            </div>--}}

{{--                                            <div>--}}
{{--                                                <label for="description" class="block text-sm font-medium text-gray-700">--}}
{{--                                                    Description--}}
{{--                                                </label>--}}
{{--                                                <div class="mt-1">--}}
{{--                                                    <textarea required id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Description">{{$video->description}}</textarea>--}}
{{--                                                </div>--}}
{{--                                                <p class="mt-2 text-sm text-gray-500">--}}
{{--                                                    Brief description for your profile. URLs are hyperlinked.--}}
{{--                                                </p>--}}
{{--                                            </div>--}}

{{--                                            <div class="grid grid-cols-3 gap-6">--}}
{{--                                                <div class="col-span-3 sm:col-span-2">--}}
{{--                                                    <label for="url" class="block text-sm font-medium text-gray-700">--}}
{{--                                                        URL--}}
{{--                                                    </label>--}}
{{--                                                    <div class="mt-1 flex rounded-md shadow-sm">--}}
{{--                  <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">--}}
{{--                    http://--}}
{{--                  </span>--}}
{{--                                                        <input required type="url" name="url" id="url" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="casteaching.jhonmoreno.codes/" value="{{$video->url}}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}



{{--                                        </div>--}}
{{--                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">--}}
{{--                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--                                                Modificar--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        @endcan


    </div>
    </div>

</x-casteaching-layout>
