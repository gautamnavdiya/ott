import { AxiosInstance } from 'axios';
import { route as ziggyRoute } from 'ziggy-js';

declare global {
  interface Window {
    axios: AxiosInstance;
  }

  var route: typeof ziggyRoute;
}

declare module '@inertiajs/core' {
  interface User {
    id: number;
    name: string;
    email: string;
    is_admin?: boolean;
  }

  interface PageProps {
    auth?: {
      user: User | null;
    };
    flash?: {
      message?: string;
      error?: string;
    };
  }
}

export {};

