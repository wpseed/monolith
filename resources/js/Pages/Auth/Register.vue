<template>
  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <jet-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <jet-label for="name" :value="$t('Name')" />
        <jet-input
          id="name"
          v-model="form.name"
          autocomplete="name"
          autofocus
          class="mt-1 block w-full"
          required
          type="text"
        />
      </div>
      <div class="mt-4">
        <jet-label for="email" :value="$t('Email')" />
        <jet-input
          id="email"
          v-model="form.email"
          class="mt-1 block w-full"
          required
          type="email"
        />
      </div>

      <div class="mt-4">
        <jet-label for="password" :value="$t('Password')" />
        <jet-input
          id="password"
          v-model="form.password"
          autocomplete="new-password"
          class="mt-1 block w-full"
          required
          type="password"
        />
      </div>

      <div class="mt-4">
        <jet-label
          for="password_confirmation"
          :value="$t('Confirm Password')"
        />
        <jet-input
          id="password_confirmation"
          v-model="form.password_confirmation"
          autocomplete="new-password"
          class="mt-1 block w-full"
          required
          type="password"
        />
      </div>

      <div
        v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
        class="mt-4"
      >
        <jet-label for="terms">
          <div class="flex items-center">
            <jet-checkbox id="terms" v-model="form.terms" name="terms" />

            <div class="ml-2">
              I agree to the
              <a
                :href="route('terms.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                target="_blank"
                >Terms of Service</a
              >
              and
              <a
                :href="route('policy.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                target="_blank"
                >Privacy Policy</a
              >
            </div>
          </div>
        </jet-label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <inertia-link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          {{ $t("Already registered?") }}
        </inertia-link>

        <jet-button
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          class="ml-4"
        >
          {{ $t("Register") }}
        </jet-button>
      </div>
    </form>

    <socialstream-providers v-if="$page.props.socialstream.show" />
  </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import SocialstreamProviders from "@/Socialstream/Providers";

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

  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false
      })
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation")
      });
    }
  }
};
</script>
