import React from 'react';

interface BrandedNavProps {
  title?: string;
  showLogo?: boolean;
  rightContent?: React.ReactNode;
}

export const BrandedNav: React.FC<BrandedNavProps> = ({
  title = 'Your Clean Team',
  showLogo = true,
  rightContent,
}) => {
  return (
    <nav className="brand-nav">
      <div className="brand-nav-content">
        {showLogo && (
          <div className="brand-nav-logo">
            <img
              src="/logo.png"
              alt="Your Clean Team Logo"
              className="brand-nav-logo-img"
            />
          </div>
        )}
        <h1 className="brand-nav-title">
          {title}
        </h1>
      </div>
      {rightContent && (
        <div className="brand-nav-right">
          {rightContent}
        </div>
      )}
    </nav>
  );
};

export default BrandedNav;
