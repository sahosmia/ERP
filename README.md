# Supplier & Fabric Management Module - Task Submission

This project is developed as part of the assessment for **Fashion Step Group** (Full Stack Web Developer position).  
The module implements **Supplier & Fabric Management** features with clean Laravel practices.

---

## 🚀 Features Implemented
### Supplier Management
- Add, Edit, Delete, Soft Delete & Restore suppliers  
- Required fields: Country, Company/Factory Name, Code, AddedBy  
- Optional fields: Email, Phone, Address, Representative (Name, Email, Phone)  
- Auto-store AddedDate, UpdatedBy, UpdatedDate using model events  
- Supplier listing with **pagination, search & filters** (by date, country, company, representative)

### Fabric Management
- Add, Edit, Delete, Soft Delete & Restore fabrics  
- Required fields: Fabric No, Composition, GSM, QTY, Cuttable Width, Production Type  
- Optional fields: Construction, Color Pantone Code, Weave, Finish, Dyeing, Printing, Lead Time, MOQ, Shrinkage, Remarks, Fabric Selected By  
- Fabric image upload (stored in `/storage/app/public/fabrics`)  
- Unique **barcode generation** per fabric roll with **print option**  
- Stock balance calculation (helper function `calculateFabricBalance($fabricId)`)

### Database & Relationships
- `suppliers` → hasMany → `fabrics`  
- `fabrics` → hasMany → `fabric_stocks`  
- `notes` polymorphic relation → can attach notes to both suppliers & fabrics  
- `users` table for AddedBy/UpdatedBy tracking  

### Polymorphic Notes System
- Shared notes table with `morphTo`, `morphMany` relations  
- Add/View notes for both Suppliers & Fabrics  

### API Endpoints
- `/api/suppliers` → CRUD + filters  
- `/api/fabrics` → CRUD + filters  
- Implemented with **Resource Controllers**  

### Other Practices
- Form Request Validation for input  
- Soft Deletes with restore option  
- Seeder with 5–10 fake suppliers & fabrics  
- Accessors/Mutators for formatting (e.g., uppercase fabric no, proper date format)  

---
