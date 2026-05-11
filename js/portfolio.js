// Portfolio Page JavaScript
// Adapted from Benjanard scraper for WordPress integration

// Global variables
let portfolioData = null;
const AUTH_KEY = 'portfolio_authenticated';

// DOM elements
const passwordGate = document.getElementById('passwordGate');
const portfolioApp = document.getElementById('portfolioApp');
const passwordForm = document.getElementById('passwordForm');
const passwordInput = document.getElementById('passwordInput');
const passwordError = document.getElementById('passwordError');
const loadingEl = document.getElementById('loading');
const errorEl = document.getElementById('error');
const contentEl = document.getElementById('content');
const errorMessageEl = document.getElementById('errorMessage');
const refreshBtn = document.getElementById('refreshBtn');

document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on the portfolio page
    if (!portfolioApp) return;
    
    // Skip password check - directly show app
    showApp();

    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            refreshBtn.disabled = true;
            const originalText = refreshBtn.innerHTML;
            refreshBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="m15 9-6 6"></path><path d="m9 9 6 6"></path></svg> Loading...';
            loadPortfolioData(true).finally(() => {
                refreshBtn.disabled = false;
                refreshBtn.innerHTML = originalText;
            });
        });
    }

    // Setup filter functionality
    setupFilters();
});

async function handlePasswordSubmit(e) {
    e.preventDefault();
    passwordError.textContent = '';
    const password = passwordInput.value.trim();
    if (!password) return;

    try {
        // Use WordPress AJAX endpoint
        const formData = new FormData();
        formData.append('action', 'portfolio_auth');
        formData.append('password', password);
        formData.append('nonce', portfolioAjax.nonce);

        const response = await fetch(portfolioAjax.ajaxurl, {
            method: 'POST',
            body: formData
        });

        const data = await response.json();
        
        if (data.success) {
            sessionStorage.setItem(AUTH_KEY, 'true');
            showApp();
        } else {
            passwordError.textContent = data.data || 'รหัสผ่านไม่ถูกต้อง';
            passwordInput.value = '';
            passwordInput.focus();
        }
    } catch (err) {
        passwordError.textContent = 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง';
        console.error('Auth error:', err);
    }
}

function showApp() {
    if (passwordGate) passwordGate.style.display = 'none';
    if (portfolioApp) portfolioApp.style.display = 'block';
    loadPortfolioData();
}

async function loadPortfolioData(forceRefresh = false) {
    showLoading();

    try {
        // Use WordPress AJAX endpoint
        const formData = new FormData();
        formData.append('action', 'get_portfolio_data');
        formData.append('refresh', forceRefresh ? '1' : '0');
        formData.append('nonce', portfolioAjax.nonce);

        const response = await fetch(portfolioAjax.ajaxurl, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        
        if (result.success) {
            portfolioData = result.data;
            displayPortfolioData();
        } else {
            throw new Error(result.data || 'Failed to load portfolio data');
        }
    } catch (error) {
        console.error('Error loading portfolio:', error);
        showError(error.message);
    } finally {
        refreshBtn.disabled = false;
        refreshBtn.textContent = 'Refresh Data';
    }
}

function showLoading() {
    loadingEl.style.display = 'block';
    errorEl.style.display = 'none';
    contentEl.style.display = 'none';
}

function showError(message) {
    loadingEl.style.display = 'none';
    errorEl.style.display = 'block';
    contentEl.style.display = 'none';
    errorMessageEl.textContent = message;
}

function displayPortfolioData() {
    if (!portfolioData) return;

    loadingEl.style.display = 'none';
    errorEl.style.display = 'none';
    contentEl.style.display = 'block';

    displayProjects();
}

function displayProjects() {
    const projectsContainer = document.getElementById('projectsContainer');
    if (!projectsContainer) return;
    
    projectsContainer.innerHTML = '';

    if (!portfolioData.projects || portfolioData.projects.length === 0) {
        projectsContainer.innerHTML = '<p class="project-description">No projects found.</p>';
        return;
    }

    portfolioData.projects.forEach(project => {
        const projectItem = createProjectItem(project);
        projectsContainer.appendChild(projectItem);
    });
}

function createProjectItem(project) {
    const item = document.createElement('article');
    item.className = `project-item ${project.status || 'regular'}`;
    item.setAttribute('data-category', project.category || 'all');

    const title = escapeHtml(project.title || 'Untitled Project');
    const subtitle = escapeHtml(project.subtitle || '');
    const description = escapeHtml(project.description || '');
    const year = project.year || new Date().getFullYear();
    const client = escapeHtml(project.client || '');
    
    // Create tags HTML
    let tagsHtml = '';
    if (project.tags && project.tags.length > 0) {
        tagsHtml = `<div class="project-tags">
            ${project.tags.slice(0, 3).map(tag => `<span class="project-tag">${escapeHtml(tag)}</span>`).join('')}
        </div>`;
    }

    // Create responsibilities HTML
    let responsibilitiesHtml = '';
    if (project.responsibilities && project.responsibilities.length > 0) {
        responsibilitiesHtml = `<div class="project-responsibilities">
            <strong>Responsibilities:</strong> ${project.responsibilities.slice(0, 3).map(resp => escapeHtml(resp)).join(' • ')}
        </div>`;
    }
    
    let linkHtml = '';
    if (project.websiteUrl && project.websiteUrl.includes('http')) {
        linkHtml = `<a href="${escapeHtml(project.websiteUrl)}" target="_blank" rel="noopener" class="project-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M7 17 17 7"></path>
                <path d="M7 7h10v10"></path>
            </svg>
            View Project
        </a>`;
    }

    // Add status badge for featured projects
    let statusBadge = '';
    if (project.status === 'featured') {
        statusBadge = '<div class="project-badge">Featured</div>';
    }

    // Create project visual with image or placeholder
    let projectVisual = '';
    if (project.image) {
        projectVisual = `
            <div class="project-visual">
                <img src="${escapeHtml(project.image)}" alt="${escapeHtml(project.imageAlt || project.title)}" class="project-image" loading="lazy">
                <div class="visual-overlay">
                    <span class="visual-text">${escapeHtml(project.title)}</span>
                </div>
            </div>
        `;
    } else {
        projectVisual = `
            <div class="project-visual">
                <div class="project-visual-placeholder">
                    <div class="visual-icon">
                        ${getCategoryIcon(project.category)}
                    </div>
                    <div class="visual-overlay">
                        <span class="visual-text">${escapeHtml(project.title)}</span>
                    </div>
                </div>
            </div>
        `;
    }

    item.innerHTML = `
        ${statusBadge}
        ${projectVisual}
        <div class="project-content">
            <div class="project-meta-top">
                <span class="project-year">${year}</span>
                ${client ? `<span class="project-client">${client}</span>` : ''}
            </div>
            <div class="project-header">
                <h3 class="project-title">${title}</h3>
                ${linkHtml}
            </div>
            ${subtitle ? `<p class="project-subtitle">${subtitle}</p>` : ''}
            <p class="project-description">${description.substring(0, 150)}${description.length > 150 ? '...' : ''}</p>
            ${tagsHtml}
            ${responsibilitiesHtml}
        </div>
    `;

    return item;
}

function getCategoryIcon(category) {
    const icons = {
        'mobile': '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>',
        'web': '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="m5 12c0-7 3-10 7-10s7 3 7 10-3 10-7 10-7-3-7-10z"></path></svg>',
        'ecommerce': '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
        'default': '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>'
    };
    return icons[category] || icons.default;
}

function setupFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            filterProjects(filterValue);
        });
    });
}

function filterProjects(category) {
    const projectItems = document.querySelectorAll('.project-item');
    
    projectItems.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        
        if (category === 'all' || itemCategory === category) {
            item.style.display = 'block';
            item.style.animation = 'fadeInUp 0.5s ease forwards';
        } else {
            item.style.display = 'none';
        }
    });
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}