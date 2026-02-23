# 🧪 Recruiter Signup Form - Quick Visual Test Guide

## ✅ What You'll See

When you click the **"Je souhaite recruter"** tab on `/signup-choice`, you'll see:

### 1️⃣ Top Badge
```
┌─────────────────────────────────┐
│   48H d'essais gratuit          │  ← Cyan gradient badge
└─────────────────────────────────┘
```

### 2️⃣ Main Heading
```
Recrutez mieux et plus rapidement
        (3xl, bold, white text)
```

### 3️⃣ Subheading
```
Publiez vos offres d'emploi, gagnez en visibilité et 
recrutez plus efficacement avec OMPLEO
     (smaller gray text, OMPLEO in cyan)
```

### 4️⃣ Question
```
Quel est votre besoin ?*
   (small text, centered)
```

### 5️⃣ Form Fields with Icons

#### First Row (2 columns):
```
┌────────────────────┬─────────────────────┐
│ Prénom *           │ Nom *               │
│ [👤] Votre prenom  │ [👤] Votre nom     │
└────────────────────┴─────────────────────┘
```

#### Full Width Fields:
```
┌──────────────────────────────────────────┐
│ Entreprise *                             │
│ [🏢] Nom de votre entreprise            │
└──────────────────────────────────────────┘

┌──────────────────────────────────────────┐
│ Adresse e-mail *                         │
│ [📧] Votre@gmail.com                    │
└──────────────────────────────────────────┘

┌──────────────────────────────────────────┐
│ Mot de passe *                           │
│ [🔐] ••••••••                           │
└──────────────────────────────────────────┘

┌──────────────────────────────────────────┐
│ Confirmer le mot de passe *              │
│ [🔐] ••••••••                           │
└──────────────────────────────────────────┘
```

### 6️⃣ Checkbox
```
☐ J'accepte les conditions d'utilisation et la 
  politique de confidentialité
```

### 7️⃣ Submit Button
```
┌──────────────────────────────────────────┐
│   Commencer mon essai gratuit            │
│   (gradient teal button, full width)     │
└──────────────────────────────────────────┘
```

### 8️⃣ Login Link
```
Déjà inscrit ? Connectez-vous
```

---

## 🎨 Icon Behavior

**Normal State:**
- Icons appear slightly dimmed (opacity 0.7)
- Teal color with slight transparency

**On Focus (When user clicks input):**
- Icon brightens up (opacity 1.0)
- More vibrant appearance
- Creates visual feedback

**Icon Files:**
- 👤 Prénom/Nom: `name.svg` - person silhouette
- 🏢 Entreprise: `entreprise.svg` - building icon
- 📧 Email: `email.svg` - envelope icon
- 🔐 Password: `pass.svg` - lock icon

---

## 🔄 Tab Switching Behavior

### "Je cherche un emploi" Tab (Candidate):
```
Header Changes:
❌ NO badge
❌ NO "48H d'essais gratuit"
✅ "Trouvez l'emploi qui vous correspond"
✅ Candidate form appears
```

### "Je souhaite recruter" Tab (Recruiter):
```
Header Changes:
✅ "48H d'essais gratuit" badge
✅ "Recrutez mieux et plus rapidement"
✅ Recruiter-specific description
✅ Recruiter form with company field
```

---

## 📋 Step-by-Step Testing

1. **Open the signup page**
   ```
   http://127.0.0.1:8000/signup-choice
   ```

2. **Verify default (Candidate) tab:**
   - [ ] See "Trouvez l'emploi qui vous correspond" heading
   - [ ] No "48H d'essais gratuit" badge
   - [ ] No "Entreprise" field
   - [ ] All icons visible

3. **Click "Je souhaite recruter" tab:**
   - [ ] Header smoothly transitions
   - [ ] New heading appears: "Recrutez mieux et plus rapidement"
   - [ ] "48H d'essais gratuit" badge visible
   - [ ] Cyan/teal styling applied
   - [ ] Form shows 6 input fields (Prénom, Nom, Entreprise, Email, Password, Confirm)

4. **Test icons:**
   - [ ] Click each input field
   - [ ] Icons brighten when field is focused
   - [ ] Icons have proper positioning (left side)
   - [ ] No overlap with text input

5. **Test on mobile:**
   - [ ] Open DevTools (F12)
   - [ ] Click phone icon to enable mobile view
   - [ ] Check that form is still readable
   - [ ] Icons still visible and properly sized
   - [ ] Button and text wrap correctly

6. **Test form submission:**
   - [ ] Fill in all fields
   - [ ] Accept terms checkbox
   - [ ] Click submit button
   - [ ] Form should submit with `user_type=recruiter`

---

## 🎯 Expected Visual Results

### Colors Used:
- **Badge**: Cyan (`#cyan-300`) on gradient background
- **Icons**: Teal/Cyan with invert filter
- **Text**: White and light gray
- **Buttons**: Teal gradient (`#165c5b` to `#00fadc`)
- **Input fields**: Dark gray with teal border (`#16b6b4`)

### Spacing:
- Badge padding: 6px vertical, 24px horizontal
- Input padding: 14px with 44px left margin for icon
- Gap between form rows: 16px
- Top margin on badge: 16px below heading

### Typography:
- Heading: 3xl, bold, white
- Subheading: small, gray, max-width container centered
- Labels: 14px, bold, light gray
- Inputs: 14px, teal border
- Placeholder text: dimmer gray

---

## 🔐 Icons Directory

All icons are located in:
```
storage/app/public/login-icons/
├── name.svg        ✅ 
├── entreprise.svg  ✅
├── email.svg       ✅
└── pass.svg        ✅
```

Being served from: `/storage/login-icons/`

---

## ✨ CSS Animation Details

### Badge Animation
- Inline gradient: `from-cyan-500/20 to-teal-500/20`
- Border: `border-cyan-500/50`
- Rounded: `rounded-full`
- Padding: `px-6 py-2.5`

### Icon Transitions
- Filter brightness on focus: smooth color change
- Opacity transition: 0.7 → 1.0
- Timing: 0.3s ease

### Form Container
- Fade in animation on tab switch
- From `hidden` class to `visible`
- Smooth transition effect

---

## 🚨 Troubleshooting

### Icons Not Showing?
- Check DevTools → Network → look for login-icons requests
- Verify files exist in `storage/app/public/login-icons/`
- Check asset paths: `{{ asset('storage/login-icons/...') }}`

### Tab Not Switching?
- Check DevTools → Console for JavaScript errors
- Verify elements exist: `getElementById('recruiterFormContainer')`
- Check browser console for switchTab() function calls

### No "48H d'essais gratuit" Badge?
- Make sure recruiter form is visible
- Badge is only in recruiter form, not candidate
- Click the correct tab first

### Icons Look Wrong?
- Check if SVG files are loading (Network tab)
- Verify SVG content is valid XML
- Check CSS filter and opacity values
- Icons should have light color with invert filter

---

## ✅ Success Checklist

- [ ] Badge appears at top of recruiter form
- [ ] Heading text is "Recrutez mieux et plus rapidement"
- [ ] All 6 form fields visible with correct icons
- [ ] Icons brighten on input focus
- [ ] Tab switching works smoothly
- [ ] Mobile view is responsive
- [ ] Form submits successfully
- [ ] Colors match your design (teal/cyan)
- [ ] No console errors
- [ ] No missing images

---

**Test URL:** `http://127.0.0.1:8000/signup-choice`

**Expected Status:** ✅ READY TO USE

---

*Last Updated: February 23, 2026*
