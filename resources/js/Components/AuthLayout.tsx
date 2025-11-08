import { Head } from '@inertiajs/react';
import type { ReactNode } from 'react';

interface AuthLayoutProps {
  children: ReactNode;
  title?: string;
  showLogo?: boolean;
}

export default function AuthLayout({ children, title, showLogo = true }: AuthLayoutProps) {
  return (
    <>
      <Head title={title} />
      <div className="min-h-screen relative overflow-hidden">
        {/* Background with gradient overlay - Netflix style */}
        <div className="absolute inset-0 bg-gradient-to-b from-black via-gray-900 to-black">
          {/* Animated background pattern */}
          <div className="absolute inset-0 opacity-20">
            <div className="absolute inset-0" style={{
              backgroundImage: `radial-gradient(circle at 20% 50%, rgba(220, 38, 38, 0.1) 0%, transparent 50%),
                                radial-gradient(circle at 80% 80%, rgba(220, 38, 38, 0.1) 0%, transparent 50%),
                                radial-gradient(circle at 40% 20%, rgba(220, 38, 38, 0.05) 0%, transparent 50%)`,
            }}></div>
          </div>
          
          {/* Subtle grid pattern */}
          <div className="absolute inset-0 opacity-5" style={{
            backgroundImage: `linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px)`,
            backgroundSize: '50px 50px'
          }}></div>
        </div>

        {/* Content */}
        <div className="relative z-10 min-h-screen flex flex-col">
          {/* Header with Logo */}
          {showLogo && (
            <header className="px-6 py-4 sm:px-8 sm:py-6">
              <div className="max-w-7xl mx-auto">
                <div className="flex items-center">
                  <h1 className="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-red-600 via-red-500 to-red-600 bg-clip-text text-transparent animate-pulse">
                    OTT
                  </h1>
                  <span className="ml-3 text-red-500 text-sm font-semibold tracking-wider">PLATFORM</span>
                </div>
              </div>
            </header>
          )}

          {/* Main Content */}
          <div className="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
            <div className="w-full max-w-md">
              {children}
            </div>
          </div>

          {/* Footer */}
          <footer className="px-6 py-4 text-center text-gray-500 text-sm">
            <p>&copy; 2024 OTT Platform. All rights reserved.</p>
          </footer>
        </div>
      </div>
    </>
  );
}
