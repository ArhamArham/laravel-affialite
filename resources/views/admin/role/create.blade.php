<x-layout title="Create Role">

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Create Role
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('userManagement.role.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="intro-y box p-5">
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control w-full" name="name"
                                   value="{{ old('Name') }}"
                                   placeholder="Enter Title">
                            @error('name')
                            <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control w-full" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Enter Email">
                            @error('email')
                            <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-1/4 px-3 mb-4">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input id="expiry_date" type="text" class="datepicker form-control"
                                   data-single-mode="true" name="expiry_date"
                                   data-format="YYYY-MM-DD"
                                   value="{{ old('expiry_date') }}"/>
                            @error('expiry_date')
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
                                       @if(old('is_active') == '1') checked @endif>
                                <input type="hidden" name="is_active" value="0" id="activeHidden">
                            </div>
                            @error('active')
                            <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-center" id="grid_loading">
                        <i data-loading-icon="grid" class="w-8 h-8"></i>
                    </div>

                    <div class="accordion accordion-boxed" id="grid" style="display: none">
                        @foreach($modules as $module)
                            <div class="accordion-item">
                                <div id="faq-accordion-content-{{ $module->id }}" class="accordion-header">
                                    <button class="accordion-button" type="button" data-tw-toggle="collapse"
                                            data-tw-target="#faq-accordion-collapse-{{ $module->id }}"
                                            aria-expanded="true"
                                            aria-controls="faq-accordion-collapse-{{ $module->id }}">
                                        {{ $module->name }}
                                    </button>
                                </div>
                                <div id="faq-accordion-collapse-{{ $module->id }}"
                                     class="accordion-collapse collapse show"
                                     aria-labelledby="faq-accordion-content-5">
                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                        <div class="">
                                            <table class="table table-striped">
                                                <tbody>
                                                @foreach($module->children as $children)
                                                    <tr>
                                                        <td>{{ $children->name }}</td>
                                                        <td style="width: 75%">
                                                            <select data-placeholder="Select"
                                                                    multiple
                                                                    name="permissions[{{ $children->id }}][]"
                                                                    class="tom-select w-full">
                                                                @foreach($children->permissions as $perKey => $permission)
                                                                    <option
                                                                        value="{{ $perKey }}">{{ ucfirst($permission) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-right mt-5">
                        <a href="{{ route('userManagement.role.index') }}"
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

            window.addEventListener('load', function () {
                setTimeout(() => {
                    document.getElementById("grid_loading").style.display = "none";
                    document.getElementById("grid").style.display = ""
                }, 200)
            })
        </script>
    </x-slot>
</x-layout>
