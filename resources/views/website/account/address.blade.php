@extends('layouts.shop')
@section('content')

@include('_partials.banner')
<div class="account_cnt" style="margin-top:20px;margin-bottom: -30px;z-index:999;">
    <div class="acc_name">
        <a href="{{ route('account.home') }}">Volver a mi cuenta</a>
    </div>
</div>
<section class="address_acc">
    <list-address inline-template :departments="{{ json_encode($states) }}" :content="{{ json_encode(__('content_vue')) }}" v-cloak>
    <div class="address_acc--cnt">
        <h3>{{ __('titles.addresses') }}</h3>
        <div class="address_content">
            <div  v-for="item in address">
            <div class="address_content--itm">
                <span class="tag-principal" v-if="item.principal == '1'"></span>
                <h6>@{{ item.address }}</h6>
                <h6>@{{ item.city.name }}</h6>
                <h6>@{{ item.state.name }}</h6>
                <h6>@{{ item.name_address }}</h6>
                <a href="" class="btn btn-primary btn-default" v-on:click.prevent="edit(item)">
                    <span v-if="item.edit == '0'">{{ __('links.edit') }}</span>
                    <span v-else>{{ __('links.hide') }}</span>
                </a>
                <a v-if="address.length > 1" href="#" class="btn btn-danger btn-delete" v-on:click.prevent="deleteAddress(item)">{{ __('links.delete') }}</a>
                
            </div>
            <transition  name="bounce">
                <div v-if="item.edit == '1'" class="item-address">
                    <form>
                    <div class="_input-group">
                        <div class="_input">  
                            <b-form-input placeholder="{{ __('forms.address') }}" v-model.trim="$v.new_address.address.$model" :state="$v.new_address.address.$dirty ? !$v.new_address.address.$invalid : null"></b-form-input>
                            <p class="error" v-if="!$v.new_address.address.required && new_address.address != null">{{ __('messages.required_address') }}</p>
                        </div>
                        <div class="_input">
                            <b-form-input placeholder="{{ __('forms.name_address') }}" v-model.trim="$v.new_address.name_address.$model" :state="$v.new_address.name_address.$dirty ? !$v.new_address.name_address.$invalid : null"></b-form-input>
                            <p class="error" v-if="!$v.new_address.name_address.required && new_address.name_address != null">{{ __('messages.required_name_address') }}</p>  
                        </div>
                    </div>
                    <div class="_input-group">
                        <div class="_input">                              
                            <select v-on:change="selectedDepartmentEdit($event, item)" v-model="new_address.state_id">
                                <option value="">{{ __('forms.state') }}</option>
                                <option v-for="state in item.states" :value="state.id_state">@{{ state.name }}</option>
                            </select>
                        </div>
                        <div class="_input">
                            <b-form-select  v-model="$v.new_address.city_id.$model" :state="$v.new_address.city_id.$dirty ? !$v.new_address.city_id.$invalid : null"> 
                                <option :value="null" selected disabled>
                                    {{ __('forms.city') }}
                                </option>
                                <option v-for="city in item.cities" :value="city.id">
                                    @{{ city.name }}
                                </option>     
                            </b-form-select> 
                        </div>
                    </div>                    
                    <div class="_input-group">
                        <div class="_input">  
                            <b-form-input placeholder="{{ __('forms.complement') }}" v-model="new_address.complement">
                        </div>
                    </div>
                    <div v-if="item.principal == '0'" class="_input-group">
                        <label>{{ __('titles.check_as_principal') }}</label>
                        <input type="checkbox" v-model="new_address.principal"  :checked="item.principal == '1' ? true : false">
                    </div>
                    <div class="_submit">  
                        <button class="btn btn-primary btn-default" type="button" v-on:click.prevent="updateAddress(item)">{{ __('links.update') }}</button>
                    </div>
                </form>
                </div>
            </transition>
            </div>
        </div>
        <div class="add_address">
            <a href="" class="btn btn-default" v-on:click.prevent="addAddress">
                <span v-if="!add_address">{{ __('links.add') }}</span>
                <span v-else>{{ __('links.hide') }}</span>
            </a>
        </div>
        <br>
        <transition  name="bounce">
            <div v-if="add_address" class="item-address">
                <form>
                    <div class="_input-group">
                        <div class="_input">  
                            <b-form-input placeholder="{{ __('forms.address') }}" v-model.trim="$v.new_address.address.$model" :state="$v.new_address.address.$dirty ? !$v.new_address.address.$invalid : null"></b-form-input>
                            <p class="error" v-if="!$v.new_address.address.required && new_address.address != null">{{ __('messages.required_address') }}</p>
                        </div>
                        <div class="_input">
                            <b-form-input placeholder="{{ __('forms.name_address') }}" v-model.trim="$v.new_address.name_address.$model" :state="$v.new_address.name_address.$dirty ? !$v.new_address.name_address.$invalid : null"></b-form-input>
                            <p class="error" v-if="!$v.new_address.name_address.required && new_address.name_address != null">{{ __('messages.required_name_address') }}</p>  
                        </div>
                    </div>
                    <div class="_input-group">
                        <div class="_input">  
                            <b-form-select v-on:change="selectedDepartment($event)" :options="departments" value-field="id_state" text-field="name" v-model="$v.new_address.state_id.$model" :state="$v.new_address.state_id.$dirty ? !$v.new_address.state_id.$invalid : null">
                            <template #first>
                            <b-form-select-option :value="null" disabled>{{ __('forms.state') }}</b-form-select-option>
                            </template>
                            </b-form-select>
                        </div>
                        <div class="_input">
                            <b-form-select  v-model="$v.new_address.city_id.$model" :state="$v.new_address.city_id.$dirty ? !$v.new_address.city_id.$invalid : null"> 
                                <option value="null" selected disabled="disabled" >
                                  {{ __('forms.city') }}
                                </option>
                                 <option v-for="city in cities" :value="city.id">@{{ city.name }}</option>     
                            </b-form-select> 
                        </div>
                    </div>                    
                    <div class="_input-group">
                        <div class="_input">  
                            <b-form-input placeholder="{{ __('forms.complement') }}" v-model="new_address.complement">
                        </div>
                    </div>
                    <div class="_submit">  
                        <button class="btn btn-primary btn-default" type="button" v-on:click.prevent="saveAddress">{{ __('links.save') }}</button>
                    </div>
                </form>
            </div>
        </transition>
    </div>
    </list-address>
</section>
@endsection