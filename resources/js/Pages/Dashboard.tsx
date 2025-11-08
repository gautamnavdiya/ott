import { Head, Link, router } from '@inertiajs/react';
import type { PageProps } from '@/types/global';

interface Content {
  id: number;
  title: string;
  description: string;
  thumbnail: string;
  poster: string;
  banner: string;
  rating: number;
  genre: string;
  type: string;
  release_year: number;
}

interface DashboardProps extends PageProps {
  featured?: Content;
  continueWatching: Content[];
  trending: Content[];
  topPicks: Content[];
}

export default function Dashboard({ featured, continueWatching, trending, topPicks, auth }: DashboardProps) {
  const ContentCard = ({ content }: { content: Content }) => (
    <div className="group cursor-pointer transform transition-all duration-300 hover:scale-105">
      <div className="relative overflow-hidden rounded-lg bg-gray-800 aspect-[2/3] mb-2">
        <img
          src={content.thumbnail}
          alt={content.title}
          className="w-full h-full object-cover group-hover:opacity-80 transition-opacity"
          onError={(e) => {
            (e.target as HTMLImageElement).src = `https://via.placeholder.com/400x600/1f2937/ef4444?text=${encodeURIComponent(content.title)}`;
          }}
        />
        <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
          <div className="absolute bottom-2 left-2 right-2">
            <p className="text-white text-sm font-semibold truncate">{content.title}</p>
            <div className="flex items-center gap-2 mt-1">
              <span className="text-yellow-400 text-xs">★ {content.rating}</span>
              <span className="text-gray-300 text-xs">•</span>
              <span className="text-gray-300 text-xs">{content.genre}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  );

  return (
    <>
      <Head title="Dashboard" />
      <div className="min-h-screen bg-gradient-to-b from-gray-900 via-black to-gray-900">
        {/* Navigation */}
        <nav className="bg-black/80 backdrop-blur-lg border-b border-gray-800 sticky top-0 z-50">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="flex justify-between items-center h-16">
              <div className="flex items-center">
                <Link href="/" className="text-3xl font-bold bg-gradient-to-r from-red-600 to-red-500 bg-clip-text text-transparent">
                  OTT
                </Link>
              </div>
              <div className="flex items-center space-x-6">
                <Link
                  href="/browse"
                  className="text-gray-300 hover:text-white transition-colors font-medium"
                >
                  Browse
                </Link>
                <Link
                  href="/watchlist"
                  className="text-gray-300 hover:text-white transition-colors font-medium"
                >
                  My List
                </Link>
                <button className="text-gray-300 hover:text-white transition-colors">
                  <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </button>
                <div className="relative group">
                  <div className="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-red-700 flex items-center justify-center text-white font-bold shadow-lg cursor-pointer hover:from-red-700 hover:to-red-800 transition-colors">
                    {auth?.user?.name?.[0] || 'U'}
                  </div>
                  <div className="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div className="py-2">
                      {auth?.user?.is_admin && (
                        <Link href="/admin" className="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                          Admin Panel
                        </Link>
                      )}
                      <button 
                        onClick={() => router.post('/logout')}
                        className="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white"
                      >
                        Logout
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>

        {/* Hero Section */}
        {featured && (
          <div 
            className="relative h-[70vh] bg-cover bg-center flex items-end"
            style={{
              backgroundImage: `linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.8)), url(${featured.banner})`,
            }}
          >
            <div className="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
            <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 z-10 w-full">
              <h1 className="text-5xl md:text-7xl font-bold text-white mb-4 drop-shadow-2xl">
                {featured.title}
              </h1>
              <p className="text-xl text-gray-300 mb-6 max-w-2xl drop-shadow-lg">
                {featured.description}
              </p>
              <div className="flex items-center gap-4 mb-6">
                <span className="text-yellow-400 font-semibold">★ {featured.rating}</span>
                <span className="text-gray-400">•</span>
                <span className="text-gray-300">{featured.release_year}</span>
                <span className="text-gray-400">•</span>
                <span className="text-gray-300">{featured.genre}</span>
                <span className="text-gray-400">•</span>
                <span className="text-gray-300">{featured.type === 'movie' ? 'Movie' : 'Series'}</span>
              </div>
              <div className="flex space-x-4">
                <button className="btn-primary flex items-center gap-2 px-8 py-3 text-lg">
                  <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                  </svg>
                  Play
                </button>
                <button className="btn-secondary flex items-center gap-2 px-8 py-3 text-lg border-2 border-white/30 hover:border-white/50">
                  <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  More Info
                </button>
              </div>
            </div>
          </div>
        )}

        {/* Content Sections */}
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-20 relative z-10">
          {/* Continue Watching */}
          {continueWatching.length > 0 && (
            <div className="mb-12">
              <h2 className="text-2xl md:text-3xl font-bold text-white mb-6">Continue Watching</h2>
              <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                {continueWatching.map((content) => (
                  <ContentCard key={content.id} content={content} />
                ))}
              </div>
            </div>
          )}

          {/* Trending Now */}
          {trending.length > 0 && (
            <div className="mb-12">
              <h2 className="text-2xl md:text-3xl font-bold text-white mb-6">Trending Now</h2>
              <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                {trending.map((content) => (
                  <ContentCard key={content.id} content={content} />
                ))}
              </div>
            </div>
          )}

          {/* Top Picks for You */}
          {topPicks.length > 0 && (
            <div className="mb-12">
              <h2 className="text-2xl md:text-3xl font-bold text-white mb-6">Top Picks for You</h2>
              <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                {topPicks.map((content) => (
                  <ContentCard key={content.id} content={content} />
                ))}
              </div>
            </div>
          )}
        </div>
      </div>
    </>
  );
}
