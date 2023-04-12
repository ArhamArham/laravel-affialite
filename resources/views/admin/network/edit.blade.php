<x-layout title="Edit Network">

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Edit Network
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('market.network.update',$network->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="intro-y box p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control w-full" name="name"
                                   value="{{ old('name', $network->name) }}"
                                   placeholder="Enter Title">
                            @error('name')
                            <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label for="is_active">Active Status</label>
                            <div class="form-switch mt-2">
                                <input type="checkbox" id="is_active" class="form-check-input"
                                       value="1"
                                       onchange="onChangeActive(this)"
                                       @if(old('is_active', $network->is_active) == '1') checked @endif>
                                <input type="hidden" name="is_active"
                                       value="{{ (old('is_active', $network->is_active) == '1') ? "1" : "0" }}"
                                       id="activeHidden">
                            </div>
                            @error('active')
                            <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>

                    </div>

                    <div class="text-right mt-5">
                        <a href="{{ route('market.network.index') }}"
                           class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                        <button type="submit" class="btn btn-primary w-24">Save</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
    <x-slot name="script">
        <script>
            function onChangeActive(e) {
                document.getElementById('activeHidden').value = e.checked ? 1 : 0
            }
        </script>
    </x-slot>
</x-layout>
