<template>
  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo/>
    </template>

    <jet-validation-errors class="mb-4"/>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <jet-label :value="$t('Email')" for="email"/>
        <jet-input id="email" v-model="form.email" autofocus class="mt-1 block w-full" required type="email"/>
      </div>

      <div class="mt-4">
        <jet-label :value="$t('Password')" for="password"/>
        <jet-input id="password" v-model="form.password" autocomplete="current-password" class="mt-1 block w-full" required
                   type="password"/>
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <jet-checkbox v-model="form.remember" name="remember"/>
          <span class="ml-2 text-sm text-gray-600">{{ $t('Remember me') }}</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <inertia-link v-if="canResetPassword" :href="route('password.request')"
                      class="underline text-sm text-gray-600 hover:text-gray-900">
          {{ $t('Forgot Your Password?') }}
        </inertia-link>

        <t-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ml-4">
          {{ $t('Login') }}
        </t-button>
      </div>
    </form>

    <socialstream-providers v-if="$page.props.socialstream.show"/>

  </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import SocialstreamProviders from '@/Socialstream/Providers'

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    SocialstreamProviders
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit() {
      this.form
        .transform(data => ({
          ...data,
          remember: this.form.remember ? 'on' : ''
        }))
        .post(this.route('login'), {
          onFinish: () => this.form.reset('password'),
        })
    }
  }
}
</script>
