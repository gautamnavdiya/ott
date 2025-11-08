import { FormEvent, useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AuthLayout from '@/Components/AuthLayout';
import Button from '@/Components/Button';
import Input from '@/Components/Input';

export default function Register() {
  const { data, setData, post, processing, errors } = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
  });

  const [registerType, setRegisterType] = useState<'email' | 'phone'>('email');

  const handleSubmit = (e: FormEvent) => {
    e.preventDefault();
    post('/register');
  };

  return (
    <AuthLayout title="Register - Create Account">
      <Head title="Sign Up" />
      
      {/* Register Card */}
      <div className="bg-black/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-800 p-8 sm:p-10 animate-slide-up">
        {/* Header */}
        <div className="mb-8">
          <h2 className="text-4xl font-bold text-white mb-2">Create Account</h2>
          <p className="text-gray-400 text-sm">Start your streaming journey today!</p>
        </div>

        {/* Register Type Toggle */}
        <div className="flex gap-2 mb-6 bg-gray-900/50 p-1 rounded-lg border border-gray-800">
          <button
            type="button"
            onClick={() => setRegisterType('email')}
            className={`flex-1 py-2.5 px-4 rounded-md text-sm font-semibold transition-all duration-300 ${
              registerType === 'email'
                ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg shadow-red-500/30'
                : 'text-gray-400 hover:text-white hover:bg-gray-800/50'
            }`}
          >
            <svg className="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Email
          </button>
          <button
            type="button"
            onClick={() => setRegisterType('phone')}
            className={`flex-1 py-2.5 px-4 rounded-md text-sm font-semibold transition-all duration-300 ${
              registerType === 'phone'
                ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg shadow-red-500/30'
                : 'text-gray-400 hover:text-white hover:bg-gray-800/50'
            }`}
          >
            <svg className="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            Phone
          </button>
        </div>

        {/* Form */}
        <form onSubmit={handleSubmit} className="space-y-5">
          <Input
            type="text"
            label="Full Name"
            value={data.name}
            onChange={(e) => setData('name', e.target.value)}
            error={errors.name}
            placeholder="John Doe"
            required
            autoFocus
            className="bg-gray-900/50 border-gray-700 focus:border-red-500 focus:ring-red-500/50"
          />

          {registerType === 'email' ? (
            <>
              <Input
                type="email"
                label="Email Address"
                value={data.email}
                onChange={(e) => setData('email', e.target.value)}
                error={errors.email}
                placeholder="your.email@example.com"
                required
                className="bg-gray-900/50 border-gray-700 focus:border-red-500 focus:ring-red-500/50"
              />
              <input type="hidden" name="phone" value="" />
            </>
          ) : (
            <>
              <Input
                type="tel"
                label="Phone Number"
                value={data.phone}
                onChange={(e) => setData('phone', e.target.value)}
                error={errors.phone}
                placeholder="+1 (555) 000-0000"
                required
                className="bg-gray-900/50 border-gray-700 focus:border-red-500 focus:ring-red-500/50"
              />
              <input type="hidden" name="email" value="" />
            </>
          )}

          <Input
            type="password"
            label="Password"
            value={data.password}
            onChange={(e) => setData('password', e.target.value)}
            error={errors.password}
            placeholder="Create a strong password"
            required
            className="bg-gray-900/50 border-gray-700 focus:border-red-500 focus:ring-red-500/50"
          />

          <Input
            type="password"
            label="Confirm Password"
            value={data.password_confirmation}
            onChange={(e) => setData('password_confirmation', e.target.value)}
            error={errors.password_confirmation}
            placeholder="Confirm your password"
            required
            className="bg-gray-900/50 border-gray-700 focus:border-red-500 focus:ring-red-500/50"
          />

          <div className="flex items-start pt-2">
            <input
              type="checkbox"
              id="terms"
              className="mt-1 w-4 h-4 rounded border-gray-600 bg-gray-900 text-red-600 focus:ring-2 focus:ring-red-500 focus:ring-offset-0 focus:ring-offset-gray-900 cursor-pointer"
              required
            />
            <label htmlFor="terms" className="ml-3 text-sm text-gray-400">
              I agree to the{' '}
              <Link href="/terms" className="text-red-500 hover:text-red-400 font-medium">
                Terms & Conditions
              </Link>{' '}
              and{' '}
              <Link href="/privacy" className="text-red-500 hover:text-red-400 font-medium">
                Privacy Policy
              </Link>
            </label>
          </div>

          <Button 
            type="submit" 
            className="w-full mt-6 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3.5 px-6 rounded-lg shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 transition-all duration-300" 
            isLoading={processing}
          >
            {processing ? 'Creating Account...' : 'Create Account'}
          </Button>
        </form>

        {/* Divider */}
        <div className="relative my-8">
          <div className="absolute inset-0 flex items-center">
            <div className="w-full border-t border-gray-800"></div>
          </div>
          <div className="relative flex justify-center text-sm">
            <span className="px-4 bg-black/80 text-gray-500 font-medium">Or sign up with</span>
          </div>
        </div>

        {/* Social Login Buttons */}
        <div className="grid grid-cols-2 gap-4">
          <button
            type="button"
            className="group w-full inline-flex items-center justify-center py-3 px-4 border-2 border-gray-700 rounded-lg bg-gray-900/50 text-sm font-semibold text-white hover:border-gray-600 hover:bg-gray-800/50 transition-all duration-300"
          >
            <svg className="w-5 h-5 mr-2" viewBox="0 0 24 24">
              <path
                fill="currentColor"
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
              />
              <path
                fill="currentColor"
                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
              />
              <path
                fill="currentColor"
                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
              />
              <path
                fill="currentColor"
                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
              />
            </svg>
            Google
          </button>
          <button
            type="button"
            className="group w-full inline-flex items-center justify-center py-3 px-4 border-2 border-gray-700 rounded-lg bg-gray-900/50 text-sm font-semibold text-white hover:border-gray-600 hover:bg-gray-800/50 transition-all duration-300"
          >
            <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
            </svg>
            Facebook
          </button>
        </div>

        {/* Sign In Link */}
        <p className="mt-8 text-center text-sm text-gray-400">
          Already have an account?{' '}
          <Link 
            href="/login" 
            className="text-red-500 hover:text-red-400 font-semibold transition-colors inline-flex items-center"
          >
            Sign in
            <svg className="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
            </svg>
          </Link>
        </p>
      </div>
    </AuthLayout>
  );
}
