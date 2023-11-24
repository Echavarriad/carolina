<div class="user_info">
	@if (!auth()->user())
		<div class="account">
            <p>¿Ya tienes una cuenta?</p>
            <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
        <div class="registered">
            <p>Comprar sin registro</p>
        </div>
	@else
        <div class="registered">
            <p>Información</p>
        </div>
        <div class="account"></div>
	@endif
</div>
<form>
    <div class="contact_cart">
        <h6>Información de contacto</h6>
        <div class="_input" style="width:100% !important;">
            <b-form-input placeholder="{{ __('forms.email') }}" v-model.trim="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null" v-on:blur="validateEmail"></b-form-input>
            <p class="error" v-if="!$v.email.required && email != null">{{ __('messages.required_email') }}</p>
            <p class="error" v-if="!$v.email.email && email != null">{{ __('messages.email_invalid') }}</p>
        </div>
        <div class="_check">
            <label for="pay_check_1">
                <input type="checkbox" name="" id="pay_check_1" v-model="newsletter">
                <span></span>
            </label>
            <p>Quiero recibir noticias y ofertas exclusivas</p>
        </div>
    </div>
    <div class="address">
        <div class="_input-group">
            <div class="_input">
                <b-form-input placeholder="{{ __('forms.name_account') }}" v-model="$v.name.$model" :state="$v.name.$dirty ? !$v.name.$invalid : null" autofocus></b-form-input>
                <p class="error" v-if="!$v.name.required && name != null">{{ __('messages.required_name') }}</p>
            </div>
            <div class="_input">
                <b-form-input placeholder="{{ __('forms.lastname') }}" v-model="$v.lastname.$model" :state="$v.lastname.$dirty ? !$v.lastname.$invalid : null" autofocus></b-form-input>
                <p class="error" v-if="!$v.lastname.required && lastname != null">{{ __('messages.required_lastname') }}</p>
            </div>
        </div>
        <div class="_input-group">
            <div class="_input">
                <b-form-select  v-model="$v.type_document.$model" :state="$v.type_document.$dirty ? !$v.type_document.$invalid : null" :options="documents" value-field="item" text-field="item">
                    <template #first>
                        <b-form-select-option :value="null" disabled>{{ __('forms.type_document') }}</b-form-select-option>
                    </template> 
                </b-form-select>
            </div>
            <div class="_input">
                <b-form-input placeholder="{{ __('forms.document') }}" v-model="$v.document.$model" :state="$v.document.$dirty ? !$v.document.$invalid : null"></b-form-input>
                <p class="error" v-if="!$v.document.required && document != null">{{ __('messages.required_document') }}</p>
            </div>
        </div>
        <div class="_input-group">
            <div class="_input">
                <b-form-input placeholder="{{ __('forms.phone') }}" v-model.trim="$v.mobile.$model" :state="$v.mobile.$dirty ? !$v.mobile.$invalid : null"></b-form-input>
                <p class="error" v-if="!$v.mobile.required && mobile != null">{{ __('messages.required_mobile') }}</p>
            </div>
            <div class="_input">
            </div>
        </div>        
        <h6>Dirección de envío</h6>
        <div class="_input-group">
            <div class="_input">
                <b-form-input placeholder="{{ __('forms.address') }}" v-model.trim="$v.address.$model" :state="$v.address.$dirty ? !$v.address.$invalid : null"></b-form-input>
                <p class="error" v-if="!$v.address.required && address != null">{{ __('messages.required_address') }}</p>
            </div>
            <div class="_input">
                <b-form-input placeholder="{{ __('forms.complement') }}" v-model="complement">
            </div>
        </div>
        <div class="_input-group">
            <div class="_input">
                <b-form-select v-on:change="selectedDepartment($event)" :options="departments" value-field="id_state" text-field="name" v-model="$v.state.$model" :state="$v.state.$dirty ? !$v.state.$invalid : null">
                <template #first>
                <b-form-select-option :value="null" disabled>{{ __('forms.state') }}</b-form-select-option>
                </template>
                </b-form-select>
            </div>
            <div class="_input">
                <b-form-select  v-model="$v.city.$model" :state="$v.city.$dirty ? !$v.city.$invalid : null"> 
                    <option value="null" selected disabled="disabled" >
                      {{ __('forms.city') }}
                    </option>
                     <option v-for="item in cities" :value="item.id">@{{ item.name }}</option>     
                </b-form-select>
            </div>
        </div>
        <div v-if="!auth" class="_check">
            <label for="pay_check_3">
                <input type="checkbox" name="" id="pay_check_3" v-on:click="checkCreateAccount"><span></span>
            </label>
            <p>Guardar mi información y consultar más rápidamente la próxima vez</p>
        </div>
        <section v-if="create_account">
            <div class="_input-group">
                <div class="_input">
                    <b-form-input type="password" placeholder="{{ __('forms.password') }}" v-model.trim="$v.login.password.$model" :state="$v.login.password.$dirty ? !$v.login.password.$invalid : null" autocomplete="new-password"></b-form-input>
                    <p class="error" v-if="!$v.login.password.required && login.password != null">{{ __('messages.required_password') }}</p>
                    <p class="error" v-if="!$v.login.password.minLength && login.password != null">{{ __('messages.min_password') }} @{{ $v.password.$params.minLength.min }} {{ __('messages.characters') }}</p>                        
                    <p class="error" v-if="!$v.login.password.isValidPassword && login.password != null">{{ __('messages.letter_number_password') }}</p>
                </div>
                <div class="_input">
                    <b-form-input type="password"placeholder="{{ __('forms.confirm_password') }}" v-model.trim="$v.login.confirm_password.$model" :state="$v.login.confirm_password.$dirty ? !$v.login.confirm_password.$invalid : null" autocomplete="new-password"></b-form-input>
                    <p class="error" v-if="!$v.login.confirm_password.sameAsPassword && login.confirm_password != null">{{ __('messages.not_same_password') }}</p>
                </div>
            </div>
        </section>
        
    </div>
    <button class="cursor" v-on:click.prevent="shipping">Pago</button>
</form>